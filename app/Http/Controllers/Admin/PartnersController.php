<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partners;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function getPartners(Request $request)
    {
        if ($request->ajax()) {
            $data = Partners::all();

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
                    $editButton = '<a href="' . route('partners.edit', ['id' => $row->id]) . '" class="btn btn-info btn-custom mr-2">Edit</a>';
                    $deleteButton = '<button class="btn btn-danger delete-user" data-id="' . $row->id . '" data-model="partners" data-toggle="modal" data-target="#deleteUserModal">Delete</button>';

                    return '<div class="d-flex">'.$editButton . ' ' . $deleteButton.'</div>';
                })
                ->rawColumns(['id', 'image', 'action'])
                ->make(true);
        }

        return view('admin.partners.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.partners.index', ['title' => 'List Partner']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create', ['title' => 'Create Partner']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the image validation as needed
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        // Create a new Partner instance
        $partner = new Partners;

        // Set individual attributes
        $partner->name = $request->input('name');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/partner_images'), $imagePath);
            $partner->image = 'assets/partner_images/' . $imagePath;
        }

        // Save the partner record to the database
        $partner->save();

        // Optionally, you can redirect the user to a specific route after successful storage
        return redirect()->route('partners.index')->with('success', 'Partner created successfully');
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
        $data = Partners::find($id);
        return view('admin.partners.edit', ['title' => 'Update Partner', 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the image validation as needed
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        // Find the Partner instance
        $partner = Partners::find($request->id);

        if ($request->hasFile('image')) {
            // Delete the old image file
            if (!empty($partner->image)) {
                File::delete(public_path($partner->image));
            }

            // Handle image update
            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/partner_images'), $imagePath);
            $partner->image = 'assets/partner_images/' . $imagePath;
        } elseif (isset($request->hidden_image)) {
            // Use the existing image if not updated
            $partner->image = $request->hidden_image;
        }

        // Update other attributes
        $partner->name = $request->input('name');

        // Save the Partner record to the database
        $partner->update();

        // Optionally, you can redirect the user to a specific route after successful update
        return redirect()->route('partners.index')->with('success', 'Partner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('id');
            $partner = Partners::find($id);

            if ($partner) {
                if (!empty($partner->image)) {
                    File::delete(public_path($partner->image));
                }
                $partner->delete();
                return response()->json(['message' => 'Partner deleted successfully']);
            } else {
                return response()->json(['message' => 'Partner not found'], 404);
            }
        }
    }
}
