<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobClass extends Model
{
    use HasFactory;

    protected $table = "job_class";

    protected $hidden = ["created_at", "updated_at"];
}
