<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Mail\JobApplicationSubmitted;
use Illuminate\Support\Facades\Mail;
// use App\Services\MpesaService;
use App\Helpers\CurrencyConverter;
use Stripe\Stripe;
use Stripe\Charge;

class JobApplicationController extends Controller
{
    // protected $mpesaService;

    // public function __construct(MpesaService $mpesaService)
    // {
    //     $this->mpesaService = $mpesaService;
    // }

    public function jobApplication($id)
    {
        $job = Job::with('jobClass')->find($id);
        // $kesAmount = CurrencyConverter::convertUsdToKes($job->jobClass->fee);
        return view('front.auth.create-job-application', compact('job'));
    }

    public function store(Request $request, $jobId)
    {
        $validator = Validator::make($request->all(), [
            'years_of_experience' => 'required|integer',
            'education_level' => 'required|string',
            'skype_id' => 'nullable|string',
            'contact_for_other_roles' => 'required|boolean',
            'languages' => 'required|array',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:1024',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $action = $request->input('action');
        $application = JobApplication::where('job_id', $jobId)->where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/cv'), $fileName);
            $cvPath = 'uploads/cv/' . $fileName;
        }

        $applicationData = [
            'job_id' => $jobId,
            'user_id' => Auth::id(),
            'years_of_experience' => $request->years_of_experience,
            'education_level' => $request->education_level,
            'skype_id' => $request->skype_id,
            'contact_for_other_roles' => $request->contact_for_other_roles,
            'languages' => $request->languages,
            'cv_path' => $cvPath,
        ];

        if ($action == 'save') {
            $applicationData['status'] = 1;
            JobApplication::create($applicationData);
            return redirect()->route('jobs.list')->with('success', 'Application saved successfully!');
        } elseif ($action == 'submit') {

            // Initiate M-Pesa payment
            $jobClassDb = JobClass::find($application->job_class);
            $amount = (int)$jobClassDb->fee + 5; // Replace with dynamic amount based on job grade
            $reference = 'JOBAPP-' . $application->id;

            $applicationData['payment_amount'] = $amount;
            $applicationData['reference'] = $reference;
            $applicationData['status'] = 2;
            $application = JobApplication::create($applicationData);

            return redirect()->route('jobs.list')->with('success', 'Job application submitted successfully.');
        }
    }

    public function jobApplicationEdit($id, $appId)
    {
        $job = Job::with('jobClass')->find($appId);
        $data = JobApplication::find($id);
        // $kesAmount = CurrencyConverter::convertUsdToKes($job->jobClass->fee);
        return view('front.auth.update-job-application', compact('job','data'));
    }

    public function edit(Request $request, $jobId)
    {
        $validator = Validator::make($request->all(), [
            'years_of_experience' => 'required|integer',
            'education_level' => 'required|string',
            'skype_id' => 'nullable|string',
            'contact_for_other_roles' => 'required|boolean',
            'languages' => 'required|array',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:1024',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $action = $request->input('action');

        $application = JobApplication::where('job_id', $jobId)->where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('cv')) {
            if (!empty($application->cv_path)) {
                File::delete(public_path($application->cv_path));
            }
            $file = $request->file('cv');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/cv'), $fileName);
            $cvPath = 'uploads/cv/' . $fileName;
            $application->cv_path = $cvPath;
        } elseif (isset($request->hidden_cv)) {
            $application->cv_path = $request->hidden_cv;
        }

        $application->years_of_experience = $request->years_of_experience;
        $application->education_level = $request->education_level;
        $application->skype_id = $request->skype_id;
        $application->contact_for_other_roles = $request->contact_for_other_roles;
        $application->languages = $request->languages;

        if ($action == 'save') {
            $application->status = 1;
            $application->save();
            return redirect()->route('jobs.list')->with('success', 'Application saved successfully!');
        } elseif ($action == 'submit') {

            // Initiate M-Pesa payment
            $jobClassDb = JobClass::find($application->job_class);
            $amount = (int)$jobClassDb->fee + 5; // Replace with dynamic amount based on job grade
            $phoneNumber = Auth::user()->mobile_number; // Assuming you store phone number in the user model
            $reference = 'JOBAPP-' . $application->id;

            $application->payment_amount = $amount;
            $application->reference = $reference;
            $application->status = 2;
            $application->save();

            return redirect()->route('jobs.list')->with('success', 'Job application submitted successfully.');
        }
    }

    // public function mpesaCallback(Request $request)
    // {
    //     $data = $request->all();

    //     // Verify the payment confirmation from M-Pesa
    //     if ($data['Body']['stkCallback']['ResultCode'] == 0) {
    //         $transactionDetails = $data['Body']['stkCallback']['CallbackMetadata']['Item'];

    //         $reference = collect($transactionDetails)->where('Name', 'Reference')->first()['Value'];
    //         $phoneNumber = collect($transactionDetails)->where('Name', 'PhoneNumber')->first()['Value'];
    //         $amount = collect($transactionDetails)->where('Name', 'Amount')->first()['Value'];

    //         // Find the job application by reference
    //         $application = JobApplication::where('reference', $reference)->first();

    //         if ($application) {
    //             $application->status = 4; // Set to submitted
    //             // $application->payment_confirmed = true; // Assuming you have a field for payment confirmation
    //             $application->save();

    //             // Send confirmation email
    //             Mail::to($application->user->email)->send(new JobApplicationSubmitted($application));
    //         }
    //     }
    // }


}
