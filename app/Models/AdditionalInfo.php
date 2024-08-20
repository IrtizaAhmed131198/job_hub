<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInfo extends Model
{
    use HasFactory;

    protected $table = "additional_info";

    protected $fillable = ['user_id'];

    protected $appends = ['resume_link'];

    public function getResumeLinkAttribute()
    {
        return $this->resume ? asset('public/' . $this->resume) : null;
    }
}
