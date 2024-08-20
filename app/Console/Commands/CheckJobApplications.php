<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JobApplication;
use App\Mail\ApplicationExpired;
use Illuminate\Support\Facades\Mail;

class CheckJobApplications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:check-applications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check job applications and mark them as expired if necessary';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $applications = JobApplication::with('job', 'user')->where('status', 2)->get();
        foreach ($applications as $application) {
            if ($application->created_at->diffInMonths(now()) > 5) {
                // Mark application as expired and send notification
                $application->status = 3; // assuming 3 is for expired
                $application->save();

                // Send notification email
                Mail::to($application->user->email)->send(new ApplicationExpired($application));
            }
        }
    }
}
