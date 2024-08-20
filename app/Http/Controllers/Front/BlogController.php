<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function blog($id)
    {
        $data = Blog::find($id);
        $related = Blog::where('id', '!=', $id)->take(7)->get();
        return view('front.blog-inner', compact('data', 'related'));
    }
}
