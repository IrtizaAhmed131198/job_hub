<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Categories;
use App\Models\JobClass;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function job(Request $request, $grid = null)
    {
        $job_count = Job::where('is_active', 1)->count();
        $is_fulltime_count = Job::where('is_active', 1)->where('is_fulltime', 1)->where('is_remote', 0)->count();
        $is_partime_count = Job::where('is_active', 1)->where('is_fulltime', 0)->where('is_remote', 0)->count();
        $is_remote_count = Job::where('is_active', 1)->where('is_remote', 1)->count();
        $Expert = Job::where('is_active', 1)->where('experience_level', 'Expert')->count();
        $Senior = Job::where('is_active', 1)->where('experience_level', 'Senior')->count();
        $Junior = Job::where('is_active', 1)->where('experience_level', 'Junior')->count();
        $Regular = Job::where('is_active', 1)->where('experience_level', 'Regular')->count();
        $Internship = Job::where('is_active', 1)->where('experience_level', 'Internship')->count();
        $Associate = Job::where('is_active', 1)->where('experience_level', 'Associate')->count();
        $categories = Categories::all();
        $job_class = JobClass::all();

        $query = Job::with('jobClass')->where('is_active', 1);

        // Add the filter for start_date
        $today = now(); // Get today's date

        $query->whereDate('start_date', '<=', $today);

        // Optional: Filter based on end_date if provided
        if ($request->has('end_date') && $request->input('end_date') != '') {
            $end_date = $request->input('end_date');
            $query->whereDate('end_date', '>=', $today);
        }

        // Add the search filter
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('company', 'like', '%' . $search . '%');
            });
        }

        // Add the location filter
        if ($request->has('location') && $request->input('location') != '') {
            $location = $request->input('location');
            $query->where('location', $location);
        }

        $jobs = $query->paginate(12);

        // Calculate pagination info
        $currentPage = $jobs->currentPage();
        $perPage = $jobs->perPage();
        $total = $jobs->total();
        $from = ($currentPage - 1) * $perPage + 1;
        $to = $currentPage * $perPage;

        // Adjust $to if on last page and not enough jobs to fill a full page
        if ($to > $total) {
            $to = $total;
        }

        return view('front.job', compact('job_count', 'jobs', 'from', 'to', 'total', 'categories', 'is_fulltime_count', 'is_partime_count', 'is_remote_count', 'Expert', 'Senior', 'Junior', 'Regular', 'Internship', 'Associate', 'grid', 'job_class'));
    }

    public function fetchJobs(Request $request)
    {
        $sort_by = $request->sort_by ?? 'newest_post';
        $searchKeyword = $request->search_keyword;
        $jobType1 = $request->job_type1;
        $jobType2 = $request->job_type2;
        $jobType3 = $request->job_type3;
        $jobLocation = $request->job_location;
        $salaryRange = $request->salary_range;
        $location = $request->location;
        $category = $request->category;
        $jobTypes = $request->job_types ?? [];
        $experienceLevels = $request->experience_levels ?? [];

        $query = Job::with('jobClass')->where('is_active', 1);

        // Apply date filters
        $today = now(); // Get today's date

        // Filter jobs that start today or in the future
        $query->whereDate('start_date', '<=', $today);

        // Optional: Filter based on end_date if provided
        if ($request->has('end_date') && !empty($request->end_date)) {
            $end_date = $request->input('end_date');
            $query->whereDate('end_date', '>=', $today);
        }

        // Apply search filter if keyword provided
        if (!empty($searchKeyword)) {
            $query->where(function ($q) use ($searchKeyword) {
                $q->where('title', 'like', '%'.$searchKeyword.'%')
                ->orWhere('location', 'like', '%'.$searchKeyword.'%');
            });
        }

        // Apply job type1 filter
        if (!empty($jobType1)) {
            if ($jobType1 == 'full time') {
                $query->where('is_fulltime', 1);
            } else if ($jobType1 == 'part time') {
                $query->where('is_fulltime', 0);
            }
        }

        // Apply job type2 filter
        if (!empty($jobType2)) {
            $query->where('class_id', $jobType2);
        }

        // Apply job type3 filter
        if (!empty($jobType3)) {
            if ($jobType3 == 'remote') {
                $query->where('is_remote', 1);
            } else if ($jobType3 == 'onsite') {
                $query->where('is_remote', 0);
            }
        }

        // Apply job location filter
        if (!empty($jobLocation)) {
            $query->where('location', 'like', '%'.$jobLocation.'%');
        }

        // Apply salary range filter
        if (!empty($salaryRange)) {
            $query->where('salary', 'like', '%'.$salaryRange.'%');
        }

        // Apply location filter
        if (!empty($location)) {
            $query->where('location', 'like', '%'.$location.'%');
        }

        // Apply category filter
        if (!empty($category)) {
            $query->where('category_id', 'like', '%'.$category.'%');
        }

        // Apply job types filter
        if (!empty($jobTypes)) {
            $query->whereIn('job_type', $jobTypes);
        }

        // Apply experience levels filter
        if (!empty($experienceLevels)) {
            $query->whereIn('experience_level', $experienceLevels);
        }

        // Apply sorting
        switch ($sort_by) {
            case 'oldest_post':
                $jobs = $query->orderBy('id', 'asc')->paginate(12);
                break;
            default:
                $jobs = $query->orderBy('id', 'desc')->paginate(12);
                break;
        }

        $currentPage = $jobs->currentPage();
        $perPage = $jobs->perPage();
        $total = $jobs->total();
        $from = ($currentPage - 1) * $perPage + 1;
        $to = $currentPage * $perPage;

        // Adjust $to if on last page and not enough jobs to fill a full page
        if ($to > $total) {
            $to = $total;
        }

        $grid = $request->grid;

        return view('front.job-list', compact('jobs', 'from', 'to', 'total', 'grid'));
    }

    public function job_inner($id)
    {
        $data = Job::with('jobClass')->find($id);
        $recent_jobs = Job::where('id', '!=', $id)->where('is_active', 1)->inRandomOrder()->take(4)->get();
        $job_app = JobApplication::where('job_id', $id)->where('user_id', Auth::id())->first();
        return view('front.job-inner', compact('data','recent_jobs','job_app'));
    }
}
