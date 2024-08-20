<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = "job_applications";

    protected $fillable = [
        'job_id',
        'user_id',
        'years_of_experience',
        'education_level',
        'skype_id',
        'contact_for_other_roles',
        'languages',
        'cv_path',
        'status',
        'payment_amount',
        'reference'
    ];

    protected $casts = [
        'languages' => 'array',
        'contact_for_other_roles' => 'boolean',
    ];

    protected $appends = ['job_title','job_class','user_name','job_status_name','cv_path_link'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCvPathLinkAttribute()
    {
        return $this->cv_path ? asset('public/' . $this->cv_path) : null;
    }

    public function getJobTitleAttribute()
    {
        $job = Job::find($this->job_id);
        return $job ? $job->title : 'Unknown Job';
    }

    public function getJobClassAttribute()
    {
        $job = Job::find($this->job_id);
        return $job ? $job->class_id : 0;
    }

    public function getUserNameAttribute()
    {
        $user = User::find($this->user_id);
        return $user ? $user->name : 'Unkown Name';
    }

    public function getJobStatusNameAttribute()
    {
        if($this->job_status == 0){
            $status = 'Screening';
        }elseif($this->job_status == 1){
            $status = 'Interview';
        }elseif($this->job_status == 2){
            $status = 'On Hold';
        }elseif($this->job_status == 3){
            $status = 'Offer';
        }elseif($this->job_status == 4){
            $status = 'Rejected';
        }else{
            $status = 'Screening';
        }
        return $status;
    }
}
