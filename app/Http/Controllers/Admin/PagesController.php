<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class PagesController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Pages List';
        if ($request->ajax()) {
            $data = Pages::all();
            return DataTables::of($data)
                ->addColumn('banner_image', function ($row) {
                    // Add any custom action buttons here
                    $banner_imageTag = "";
                    if (!empty($row->banner_image) && $row->banner_image != null) {
                        $banner_imageUrl = asset('public/' . $row->banner_image);
                        $banner_imageTag = '<img src="' . $banner_imageUrl . '" style="height: 100px; width:300px;;">';
                    }
                    return $banner_imageTag;
                })
                ->addColumn('action', function ($row) {
                    // Add any custom action buttons here
                    $printButton = '<a href="'  . route('pages.edit', $row->id) . '" class="btn btn-primary">Edit</a>';

                    return $printButton;
                })
                ->rawColumns(['banner_image', 'action'])
                ->make(true);
        }
        return view('admin.pages.index', compact('title'));
    }

    public function create()
    {
        $title = 'Page Create';
        return view('admin.pages.create', compact('title'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'sub_title' => 'nullable|string',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'page_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }


        $page = new Pages();
        $page->title = $request->input('title');
        $page->sub_title = $request->input('sub_title');
        $page->short_description = $request->input('short_description');
        $page->long_description = serialize($request->input('long_description'));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images/pages'), $imagePath);
            $page->image = 'admin/images/pages/' . $imagePath;
        }

        $page->page_type = $request->input('page_type');
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page created successfully');
    }

    public function edit($id)
    {
        $title = 'Page Edit';
        $page = Pages::find($id);
        return view('admin.pages.edit', compact('title', 'page'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'sub_title' => 'nullable|string',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }


        $page = Pages::find($id);

        $page->title = $request->input('title');
        $page->sub_title = $request->input('sub_title');
        $page->short_description = $request->input('short_description');
        $page->long_description = serialize($request->input('long_description'));
        $page->link = $request->input('link');

        if ($request->hasFile('image')) {
            // Delete the old image file
            if (!empty($page->image)) {
                File::delete(public_path($page->image));
            }

            // Handle image update
            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images/pages'), $imagePath);
            $page->image = 'admin/images/pages/' . $imagePath;
        }
        if ($request->hasFile('banner_image')) {
            // Delete the old image file
            if (!empty($page->banner_image)) {
                File::delete(public_path($page->banner_image));
            }

            // Handle image update
            $banner_image = $request->file('banner_image');
            $banner_imagePath = time() . '.' . $banner_image->getClientOriginalExtension();
            $banner_image->move(public_path('admin/images/pages'), $banner_imagePath);
            $page->banner_image = 'admin/images/pages/' . $banner_imagePath;
        }
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page updated successfully');
    }

    public function show($id)
    {
        $page = Pages::find($id);
        return view('pages.show', compact('page'));
    }

    public function destroy($id)
    {
        $page = Pages::find($id);

        if (!empty($page->image)) {
            File::delete(public_path($page->image));
        }

        $page->delete();

        return redirect()->route('pages.index')->with('success', 'Page deleted successfully');
    }
}
