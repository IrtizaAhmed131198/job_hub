<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getBlogs(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::all();

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
                    $editButton = '<a href="' . route('blog.edit', ['id' => $row->id]) . '" class="btn btn-info btn-custom mr-2">Edit</a>';
                    $deleteButton = '<button class="btn btn-danger delete-user" data-id="' . $row->id . '" data-model="blog" data-toggle="modal" data-target="#deleteUserModal">Delete</button>';

                    return '<div class="d-flex">'.$editButton . ' ' . $deleteButton.'</div>';
                })
                ->rawColumns(['id', 'image', 'action'])
                ->make(true);
        }

        return view('admin.blog.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.blog.index', ['title' => 'List Blog Posts']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create', ['title' => 'Create Blog Post']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the image validation as needed
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        // Create a new Blog instance
        $blog = new Blog;

        // Set individual attributes
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->author = $request->input('author');
        $blog->published_at = $request->input('published_at');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/blog_images'), $imagePath);
            $blog->image = 'assets/blog_images/' . $imagePath;
        }

        // Save the blog record to the database
        $blog->save();

        // Optionally, you can redirect the user to a specific route after successful storage
        return redirect()->route('blog.index')->with('success', 'Blog post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implement this method if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Blog::find($id);
        return view('admin.blog.edit', ['title' => 'Update Blog Post', 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the image validation as needed
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        // Find the Blog instance
        $blog = Blog::find($request->id);

        if ($request->hasFile('image')) {
            // Delete the old image file
            if (!empty($blog->image)) {
                File::delete(public_path($blog->image));
            }

            // Handle image update
            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/blog_images'), $imagePath);
            $blog->image = 'assets/blog_images/' . $imagePath;
        } elseif (isset($request->hidden_image)) {
            // Use the existing image if not updated
            $blog->image = $request->hidden_image;
        }

        // Update other attributes
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->author = $request->input('author');
        $blog->published_at = $request->input('published_at');

        // Save the Blog record to the database
        $blog->update();

        // Optionally, you can redirect the user to a specific route after successful update
        return redirect()->route('blog.index')->with('success', 'Blog post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('id');
            $blog = Blog::find($id);

            if ($blog) {
                if (!empty($blog->image)) {
                    File::delete(public_path($blog->image));
                }
                $blog->delete();
                return response()->json(['message' => 'Blog post deleted successfully']);
            } else {
                return response()->json(['message' => 'Blog post not found'], 404);
            }
        }
    }
}
