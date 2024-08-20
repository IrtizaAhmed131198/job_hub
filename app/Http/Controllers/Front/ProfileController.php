<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AdditionalInfo;
use App\Models\Skills;
use App\Models\JobApplication;
use App\Models\JobClass;

class ProfileController extends Controller
{
    public function dashboard()
    {
        return view('front.auth.dashboard');
    }

    public function viewProfile()
    {
        return view('front.auth.view-profile');
    }

    public function updateProfile()
    {
        $skills = Skills::all();
        $data = User::with('additionalInfo')->where('id', Auth::user()->id)->first();
        return view('front.auth.update-profile', compact('data', 'skills'));
    }

    public function postUpdateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->id),
            ],
            'password' => 'nullable|string|min:8',
            'mobile_number' => 'required|string|min:10|max:15',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'citizenship' => 'required|string',
            'passport_number' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'nullable|string',
            'charge' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'experience' => 'nullable|string',
            'bio' => 'nullable|string',
            'resume' => 'nullable|mimes:pdf,doc,docx,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        // Update user profile
        $user = User::find($request->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->mobile_number = $request->input('mobile_number');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->postal_code = $request->input('postal_code');
        $user->citizenship = $request->input('citizenship');
        $user->passport_number = $request->input('passport_number');

        if ($request->hasFile('image')) {

            if (!empty($user->image)) {
                File::delete(public_path($user->image));
            }
            // Handle the image upload
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/user_images/'), $imageName);
            $user->image = 'assets/user_images/' .$imageName;
        } elseif (isset($request->hidden_image)) {
            // Use the existing image if not updated
            $user->image = $request->hidden_image;
        }

        $user->save();

        // Update or create additional info
        $additionalInfo = AdditionalInfo::where('user_id', $user->id)->firstOrNew(['user_id' => $user->id]);
        $additionalInfo->position = $request->input('position');
        $additionalInfo->charge = $request->input('charge');
        $additionalInfo->skills = implode(',', $request->input('skills', []));
        $additionalInfo->experience = $request->input('experience');
        $additionalInfo->bio = $request->input('bio');

        if ($request->hasFile('resume')) {
            if (!empty($additionalInfo->image)) {
                File::delete(public_path($additionalInfo->image));
            }
            $file = $request->file('resume');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/resumes'), $fileName);
            $additionalInfo->resume = 'uploads/resumes/' . $fileName;
        } elseif (isset($request->hidden_resume)) {
            // Use the existing file if not updated
            $user->image = $request->hidden_resume;
        }

        $additionalInfo->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function list()
    {
        return view('front.auth.job-list');
    }

    public function getList(Request $request)
    {
        if ($request->ajax()) {
            $data = JobApplication::where('status', '!=', 0)->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    // Add row counter
                    static $counter = 0;
                    $counter++;
                    return $counter;
                })
                ->addColumn('job_class', function ($row) {
                    $jobclass = JobClass::find($row->job_class);
                    return $jobclass->class;
                })
                ->addColumn('action', function ($row) {
                    // Add any custom action buttons here
                    if($row->status == 1){
                        $editButton = '<a href="' . route('jobApplicationEdit', ['id' => $row->id, 'appId' => $row->job_id]) . '" class="btn btn-info btn-custom mr-2">Not Complete</a>';
                    }else if($row->status == 2){
                        $editButton = '<a href="' . route('jobApplicationEdit', ['id' => $row->id, 'appId' => $row->job_id]) . '" class="btn btn-info btn-custom mr-2">Payment Complete</a>';
                    }else if($row->status == 3){
                        $editButton = '<a href="' . route('jobApplicationEdit', ['id' => $row->id, 'appId' => $row->job_id]) . '" class="btn btn-info btn-custom mr-2">Expire</a>';
                    }else{
                        $editButton = '<a href="' . route('jobApplicationEdit', ['id' => $row->id, 'appId' => $row->job_id]) . '" class="btn btn-info btn-custom mr-2">Payment Complete</a>';
                    }

                    return '<div class="d-flex">'.$editButton.'</div>';
                })
                ->rawColumns(['sno', 'action'])
                ->make(true);
        }

        return view('front.auth.job-list');
    }
}
