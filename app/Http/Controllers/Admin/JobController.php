<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobClass;
use App\Models\Categories;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class JobController extends Controller
{
    public function getJobs(Request $request)
    {
        if ($request->ajax()) {
            $data = Job::all();

            return DataTables::of($data)
                ->addColumn('id', function ($row) {
                    // Add row counter
                    static $counter = 0;
                    $counter++;
                    return $counter;
                })
                ->addColumn('image', function ($row) {
                    // Add any custom action buttons here
                    $imageUrl = $row->image_link;
                    return $imageUrl ? '<img src="'.$imageUrl.'" style="height: 50px; width: auto;">' : 'No Image';
                })
                ->addColumn('action', function ($row) {
                    // Add any custom action buttons here
                    $editButton = '<a href="' . route('job.edit', ['id' => $row->id]) . '" class="btn btn-info btn-custom mr-2">Edit</a>';
                    $deleteButton = '<button class="btn btn-danger delete-user" data-id="' . $row->id . '" data-model="job" data-toggle="modal" data-target="#deleteUserModal">Delete</button>';

                    return '<div class="d-flex">'.$editButton . ' ' . $deleteButton.'</div>';
                })
                ->rawColumns(['id', 'image', 'action'])
                ->make(true);
        }

        return view('admin.job.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.job.index', ['title' => 'List Jobs']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        $job_class = JobClass::all();
        return view('admin.job.create', ['title' => 'Create Job', 'categories' => $categories, 'job_class' => $job_class]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'new_category_name' => 'required_if:category_id,other|string|nullable',
            'title' => 'required|string',
            'short_desc' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company' => 'required|string',
            'company_logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_web_link' => ['required', 'string', 'regex:/^(http|https):\/\/([\w\-]+\.)+[\w\-]+(\/[\w\- .\/?%&=]*)?$/'],
            'location' => 'required|string',
            'salary' => 'nullable|string',
            'start_date' => 'nullable|string',
            'end_date' => 'nullable|string',
            'address' => 'nullable|string',
            'number' => 'nullable|string',
            'email' => 'nullable|string|email',
            'time_slot' => 'nullable|string',
            'experience_level' => 'nullable|string',
            'is_remote' => 'required|boolean',
            'is_fulltime' => 'required|boolean',
            'is_urgent' => 'required|boolean',
            'is_active' => 'required|boolean',
            'is_feature' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        if ($request->input('category_id') == 'other') {
            $newCategory = Categories::create([
                'name' => $request->input('new_category_name'),
            ]);
            $categoryId = $newCategory->id;
        } else {
            $categoryId = $request->input('category_id');
        }

        $job = new Job;

        $job->category_id = $categoryId;
        $job->title = $request->input('title');
        $job->short_desc = serialize($request->input('short_desc'));
        $job->description = serialize($request->input('description'));
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/job_images'), $imagePath);
            $job->image = 'assets/job_images/' . $imagePath;
        }
        if ($request->hasFile('company_logo')) {
            $company_logo = $request->file('company_logo');
            $companylogoPath = time() . '.' . $company_logo->getClientOriginalExtension();
            $company_logo->move(public_path('assets/company_images'), $companylogoPath);
            $job->company_logo = 'assets/company_images/' . $companylogoPath;
        }
        $job->company = $request->input('company');
        $job->company_web_link = $request->input('company_web_link');
        $job->location = $request->input('location');
        $job->salary = $request->input('salary');
        $job->start_date = $request->input('start_date');
        $job->end_date = $request->input('end_date');
        $job->address = $request->input('address');
        $job->number = $request->input('number');
        $job->email = $request->input('email');
        $job->time_slot = $request->input('time_slot');
        $job->experience_level = $request->input('experience_level');
        $job->is_remote = $request->input('is_remote');
        $job->is_fulltime = $request->input('is_fulltime');
        $job->is_urgent = $request->input('is_urgent');
        $job->is_active = $request->input('is_active');
        $job->is_feature = $request->input('is_feature');

        $job->save();

        return redirect()->route('job.index')->with('success', 'Job created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Job::find($id);
        $categories = Categories::all();
        $job_class = JobClass::all();
        return view('admin.job.edit', ['title' => 'Update Job', 'data' => $data, 'categories' => $categories, 'job_class' => $job_class]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'new_category_name' => 'required_if:category_id,other|string|nullable',
            'title' => 'required|string',
            'short_desc' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company' => 'required|string',
            'company_logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_web_link' => ['required', 'string', 'regex:/^(http|https):\/\/([\w\-]+\.)+[\w\-]+(\/[\w\- .\/?%&=]*)?$/'],
            'location' => 'required|string',
            'salary' => 'nullable|string',
            'start_date' => 'nullable|string',
            'end_date' => 'nullable|string',
            'address' => 'nullable|string',
            'number' => 'nullable|string',
            'email' => 'nullable|string|email',
            'time_slot' => 'nullable|string',
            'experience_level' => 'nullable|string',
            'is_remote' => 'required|boolean',
            'is_fulltime' => 'required|boolean',
            'is_urgent' => 'required|boolean',
            'is_active' => 'required|boolean',
            'is_feature' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        if ($request->input('category_id') == 'other') {
            $newCategory = Categories::create([
                'name' => $request->input('new_category_name'),
            ]);
            $categoryId = $newCategory->id;
        } else {
            $categoryId = $request->input('category_id');
        }

        $job = Job::find($request->id);

        $job->category_id = $categoryId;
        $job->title = $request->input('title');
        $job->short_desc = serialize($request->input('short_desc'));
        $job->description = serialize($request->input('description'));
        if ($request->hasFile('image')) {
            if (!empty($job->image)) {
                File::delete(public_path($job->image));
            }

            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/job_images'), $imagePath);
            $job->image = 'assets/job_images/' . $imagePath;
        } elseif (isset($request->hidden_image)) {
            $job->image = $request->hidden_image;
        }

        if ($request->hasFile('company_logo')) {
            if (!empty($job->company_logo)) {
                File::delete(public_path($job->company_logo));
            }

            $company_logo = $request->file('company_logo');
            $companylogoPath = time() . '.' . $company_logo->getClientOriginalExtension();
            $company_logo->move(public_path('assets/company_images'), $companylogoPath);
            $job->company_logo = 'assets/company_images/' . $companylogoPath;
        } elseif (isset($request->hidden_company_logo)) {
            $job->company_logo = $request->hidden_company_logo;
        }

        $job->company = $request->input('company');
        $job->company_web_link = $request->input('company_web_link');
        $job->location = $request->input('location');
        $job->salary = $request->input('salary');
        $job->start_date = $request->input('start_date');
        $job->end_date = $request->input('end_date');
        $job->address = $request->input('address');
        $job->number = $request->input('number');
        $job->email = $request->input('email');
        $job->time_slot = $request->input('time_slot');
        $job->experience_level = $request->input('experience_level');
        $job->is_remote = $request->input('is_remote');
        $job->is_fulltime = $request->input('is_fulltime');
        $job->is_urgent = $request->input('is_urgent');
        $job->is_active = $request->input('is_active');
        $job->is_feature = $request->input('is_feature');

        $job->update();

        return redirect()->route('job.index')->with('success', 'Job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('id');
            $job = Job::find($request->id);

            if ($job) {
                if (!empty($job->image)) {
                    File::delete(public_path($job->image));
                }
                if (!empty($job->company_logo)) {
                    File::delete(public_path($job->company_logo));
                }
                $job->delete();
                return response()->json(['message' => 'Job deleted successfully']);
            } else {
                return response()->json(['message' => 'Job not found'], 404);
            }
        }
    }
}
