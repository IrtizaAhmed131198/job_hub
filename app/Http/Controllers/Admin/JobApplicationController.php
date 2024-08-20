<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobClass;
use App\Models\JobApplication;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationStatusUpdated;
use App\Services\MpesaService;

class JobApplicationController extends Controller
{
    protected $mpesaService;

    public function __construct(MpesaService $mpesaService)
    {
        $this->mpesaService = $mpesaService;
    }

    public function getJobsApplication(Request $request)
    {
        if ($request->ajax()) {
            $data = JobApplication::where('status', '!=', 0)->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    // Add row counter
                    static $counter = 0;
                    $counter++;
                    return $counter;
                })
                ->addColumn('job_class', function ($row) {
                    $jobclass = JobClass::find($row->job_class);
                    return $jobclass->class;
                })
                ->addColumn('status', function ($row) {
                    // Add any custom action buttons here
                    if($row->status == 5){
                        $status = 'Refund';
                    }elseif($row->status == 1){
                        $status = 'Pending';
                    }elseif($row->status == 2){
                        $status = 'Request for payment';
                    }elseif($row->status == 3){
                        $status = 'Expired/Rejected';
                    }elseif($row->status == 4){
                        $status = 'Paid';
                    }

                    return $status;
                })
                ->addColumn('job_status', function ($row) {
                    // Add any custom action buttons here
                    if($row->job_status == 0){
                        $status = 'Screening';
                    }elseif($row->job_status == 1){
                        $status = 'Interview';
                    }elseif($row->job_status == 2){
                        $status = 'On Hold';
                    }elseif($row->job_status == 3){
                        $status = 'Offer';
                    }elseif($row->job_status == 4){
                        $status = 'Rejected';
                    }else{
                        $status = 'Screening';
                    }

                    return $status;
                })
                ->addColumn('action', function ($row) {
                    // Add any custom action buttons here
                    $editButton = '<a href="' . route('jobapp.edit', ['id' => $row->id]) . '" class="btn btn-info btn-custom mr-2">Update Status</a>';

                    return '<div class="d-flex">'.$editButton.'</div>';
                })
                ->rawColumns(['sno', 'job_status', 'action'])
                ->make(true);
        }

        return view('admin.job_app.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.job_app.index', ['title' => 'List Jobs Aplication']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = JobApplication::find($id);
        return view('admin.job_app.edit', ['title' => 'Update Status', 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $application = JobApplication::find($request->id);
        $application->job_status = $request->job_status;
        $application->save();

        Mail::to($application->user->email)->send(new ApplicationStatusUpdated($application));

        // Optionally, you can redirect the user to a specific route after successful update
        return redirect()->route('jobapp.index')->with('success', 'Status updated successfully');
    }

    public function refund($id)
    {
        $application = JobApplication::find($id);
        if ($application && $application->status == 3) {
            $amount = $application->payment_amount;
            $phoneNumber = $application->user->mobile_number; // Assuming phone number is stored in user model
            $response = $this->mpesaService->initiateB2C($amount, $phoneNumber, 'BusinessPayment', 'Refund for job application', 'Refund');

            if ($response->ResponseCode == '0') {
                return redirect()->route('applications.list')->with('success', 'Refund initiated successfully!');
            } else {
                return redirect()->back()->withErrors(['error' => 'Failed to initiate refund. Please try again.']);
            }
        }
        return redirect()->back()->withErrors(['error' => 'Invalid application or status']);
    }

    public function mpesaB2CCallback(Request $request)
    {
        $data = $request->all();
        if ($data['Body']['stkCallback']['ResultCode'] == 0) {
            $transactionDetails = $data['Body']['stkCallback']['CallbackMetadata']['Item'];

            $reference = collect($transactionDetails)->where('Name', 'Reference')->first()['Value'];

            // Find the job application by reference
            $application = JobApplication::where('reference', $reference)->first();

            if ($application) {
                $application->status = 5; // Set to submitted
                // $application->payment_confirmed = true; // Assuming you have a field for payment confirmation
                $application->save();

                // Send confirmation email
                // Mail::to($application->user->email)->send(new JobApplicationSubmitted($application));
            }
        }
    }
}
