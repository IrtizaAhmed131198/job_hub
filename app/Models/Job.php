<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Job extends Model
{
    use HasFactory;

    protected $table = "job";

    protected $appends = ['image_link', 'company_logo_link', 'created_at_ago', 'job_type', 'domain', 'job_type2', 'start_format', 'end_format'];

    public function getImageLinkAttribute()
    {
        return $this->image ? asset('public/' . $this->image) : null;
    }

    public function getCompanyLogoLinkAttribute()
    {
        return $this->company_logo ? asset('public/' . $this->company_logo) : null;
    }

    public function category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function jobClass()
    {
        return $this->hasOne(JobClass::class, 'id', 'class_id');
    }

    public function getCreatedAtAgoAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getJobTypeAttribute()
    {
        $is_fulltime = $this->is_fulltime == 1 ? 'Full-Time' : 'Part-Time';
        return $is_fulltime;
    }

    public function getJobType2Attribute()
    {
        $is_remote = $this->is_remote == 1 ? 'Remote' : 'Onsite';
        return $is_remote;
    }

    public function getDomainAttribute()
    {
        // Parse the URL to get components
        $parsedUrl = parse_url($this->company_web_link);

        // Get the host part (e.g., www.interctive.com or interctive.com)
        $host = $parsedUrl['host'] ?? '';

        // Remove the "www." prefix if it exists
        $domain = str_replace('www.', '', $host);

        return $domain;
    }

    public function getStartFormatAttribute()
    {
        $formattedDate = Carbon::parse($this->start_date)->format('F d, Y');

        return $formattedDate;
    }

    public function getEndFormatAttribute()
    {
        $formattedDate = Carbon::parse($this->end_date)->format('F d, Y');

        return $formattedDate;
    }
}
