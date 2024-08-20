<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\SignUpMail;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('id', '!=', 1)->where('role_id', '!=', 1)->where('status', 1)->with('role')->get();

            return DataTables::of($data)
                ->addColumn('id', function ($row) {
                    // Add row counter
                    static $counter = 0;
                    $counter++;
                    return $counter;
                })
                ->addColumn('action', function ($row) {
                    // Add any custom action buttons here
                    $editButton = '<a href="' . route('users.edit', ['id' => $row->id]) . '" class="btn btn-info btn-custom mr-2">Edit</a>';
                    $deleteButton = '<button class="btn btn-danger delete-user" data-id="' . $row->id . '" data-model="users" data-toggle="modal" data-target="#deleteUserModal">Delete</button>';

                    return '<div class="d-flex">'.$editButton . ' ' . $deleteButton.'</div>';
                })

                ->rawColumns(['id', 'action'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index', ['title' => 'List User']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create', ['title' => 'Create User']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8',
            'phone_number' => 'required',
            'dob' => 'required',
            'role_id' => 'required',
            'company_name' => $request->input('role_id') == 2 ? 'required' : '',
        ]);

        if ($validator->fails()) {
            return back()->with('error' , $validator->errors());
        }

        // Fetch the authenticated user
        $user = new User;
        // Update the user's profile
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone_number = $request->input('phone_number');
        $user->dob = $request->input('dob');
        $user->country = $request->input('country');
        $user->state = $request->input('state');
        $user->city = $request->input('city');
        $user->role_id = $request->input('role_id');
        $user->company_name = $request->input('company_name');
        $user->active = 1;
        $user->verified_from_idenfy = 1;
        $user->otp_verified = 1;
        $user->save();

        try {
            if ($request->input('role_id') == 2) {
                $role = 'Company';
            } else {
                $role = 'Employee';
            }
            Mail::to($request->input('email'))->send(new SignUpMail($request->input('name')));
        } catch (\Exception $e) {
            // If the email sending fails, handle the exception here
            return redirect()->route('users.index')->with('success', $role.' created successfully but email not sent!');
        }

        // Redirect back or to a success page
        return redirect()->route('users.index')->with('success', $role.' created successfully and email sent!');
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
        $data = User::find($id);
        return view('admin.users.edit', ['title' => 'Update User' , 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->id), // Ignore the current user's email
            ],
            'password' => 'nullable|string|min:8',
            'phone_number' => 'required',
            'dob' => 'required',
            'role_id' => 'required',
            'id' => 'required',
            'company_name' => $request->input('role_id') == 2 ? 'required' : '',
        ]);

        if ($validator->fails()) {
            return back()->with('error' , $validator->errors());
        }

        // Fetch the authenticated user
        $user = User::find($request->id);
        // Update the user's profile
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone_number = $request->input('phone_number');
        $user->dob = $request->input('dob');
        $user->country = $request->input('country');
        $user->state = $request->input('state');
        $user->city = $request->input('city');
        $user->role_id = $request->input('role_id');

        if($request->input('role_id') == 2){
            $role = 'Company';
            $company_name = $request->input('company_name');
        }else{
            $role = 'Employee';
            $company_name = null;
        }

        $user->company_name = $company_name;
        $user->update();

        // Redirect back or to a success page
        return redirect()->route('users.index')->with('success', $role.' updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $userId = $request->input('id');
            $user = User::find($userId);

            if ($user) {
                $user->delete();
                return response()->json(['message' => 'User deleted successfully']);
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }
        }
    }
}
