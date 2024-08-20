<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Partners;
use App\Models\Categories;
use App\Models\Blog;
use App\Models\Subscribe;
use App\Models\Job;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ThankYouForSubscribing;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partners::all();
        $blog = Blog::orderBy('id', 'DESC')->take(7)->get();
        $categories2 = Categories::all()->take(6);

        $categories = Categories::all()->shuffle()->take(7);
        foreach ($categories as $category) {
            $jobCount = Job::where('category_id', $category->id)->where('is_active', 1)->count();
            $category->job_count = $jobCount;
        }
        $job_count = Job::where('is_active', 1)->count();
        $job = Job::with('category')->where('is_active', 1)->get();
        return view('front.home', compact('partners','categories','blog','job_count','job','categories2'));
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->with('error' , $validator->errors());
        }

        // Save the subscription
        $subscribe = Subscribe::create([
            'email' => $request->email,
        ]);

        // Send thank you email
        Mail::to($request->email)->send(new ThankYouForSubscribing());

        return response()->json(['message' => 'Subscription successful!'], 200);
    }

}
