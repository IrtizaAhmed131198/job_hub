<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Categories::all();

            return DataTables::of($data)
                ->addColumn('id', function ($row) {
                    // Add row counter
                    static $counter = 0;
                    $counter++;
                    return $counter;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    // Add any custom action buttons here
                    $editButton = '<a href="' . route('categories.edit', ['id' => $row->id]) . '" class="btn btn-info btn-custom mr-2">Edit</a>';
                    $deleteButton = '<button class="btn btn-danger delete-user" data-id="' . $row->id . '" data-model="categories" data-toggle="modal" data-target="#deleteUserModal">Delete</button>';

                    return '<div class="d-flex">'.$editButton . ' ' . $deleteButton.'</div>';
                })
                ->rawColumns(['id', 'name', 'action'])
                ->make(true);
        }

        return view('admin.categories.index', ['title' => 'List Categories']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin.categories.index', ['title' => 'List Categories']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create', ['title' => 'Create Categories']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        // Create a new category instance
        $category = new Categories;

        // Set individual attributes
        $category->name = $request->input('name');

        // Save the category record to the database
        $category->save();

        // Optionally, you can redirect the user to a specific route after successful storage
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Categories::find($id);
        return view('admin.categories.edit', ['title' => 'Update Category' , 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        // Create a new category instance
        $category = Categories::find($request->id);

        // Set individual attributes
        $category->name = $request->input('name');

        // Save the category record to the database
        $category->update();

        // Optionally, you can redirect the user to a specific route after successful update
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Categories::find($request->id);

        if ($category) {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        } else {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }
    }
}
