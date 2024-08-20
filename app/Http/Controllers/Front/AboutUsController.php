<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class AboutUsController extends Controller
{
    public function aboutus()
    {
        $blog = Blog::orderBy('id', 'DESC')->take(7)->get();
        return view('front.aboutus', compact('blog'));
    }
}
