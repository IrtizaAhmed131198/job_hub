<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\Job;

class HomeController extends Controller
{
    public function index(){

        $applications = JobApplication::where('status', 2)->get();
        $app = JobApplication::count();
        $totalAmount = $applications->sum('payment_amount');

        $users = User::where('status', 1)->count();
        $job = Job::where('is_active', 1)->count();

        return view('admin.dashboard',['title' => 'Home Page', 'totalAmount' => $totalAmount, 'app' => $app, 'users' => $users, 'job' => $job]);
    }
}
