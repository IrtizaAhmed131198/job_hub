<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    public function getPost(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::all();

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
                    $editButton = '<a href="' . route('post.edit', ['id' => $row->id]) . '" class="btn btn-info btn-custom mr-2">Edit</a>';
                    $deleteButton = '<button class="btn btn-danger delete-user" data-id="' . $row->id . '" data-model="post" data-toggle="modal" data-target="#deleteUserModal">Delete</button>';

                    return '<div class="d-flex">'.$editButton . ' ' . $deleteButton.'</div>';
                })
                ->rawColumns(['id', 'image', 'action'])
                ->make(true);
        }

        return view('admin.post.index');
    }

    public function index()
    {
        $data = Post::all();
        return view('admin.post.index', compact('data'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'title' => 'required|string',
        'content' => 'required|text',
        'image' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token']);


// Handle file upload for 'image'
if ($request->hasFile('image')) {
    $file = $request->file('image');
    $fileName = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('assets/post_images'), $fileName);
    $data['image'] = 'assets/post_images/' . $fileName;
}

        Post::create($data);

        return redirect()->route('post.index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $data = Post::findOrFail($id);
        return view('post.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
        'title' => 'required|string',
        'content' => 'required|text',
        'image' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = Post::findOrFail($id);


// Handle file update for 'image'
if ($request->hasFile('image')) {
    // Delete the old file if it exists
    if (!empty($data->image)) {
        File::delete(public_path($data->image));
    }

    $file = $request->file('image');
    $fileName = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('assets/post_images'), $fileName);
    $data->image = 'assets/post_images/' . $fileName;
} elseif ($request->has('hidden_' . 'image')) {
    // Use the existing file if not updated
    $data->image = $request->input('hidden_' . 'image');
}

        $data->update($request->all());

        return redirect()->route('post.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $data = Post::findOrFail($id);


// Delete file if necessary for 'image'
if (!empty($data->image)) {
    File::delete(public_path($data->image));
}

        $data->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully.');
    }
}
