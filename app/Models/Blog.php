<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blog";

    protected $appends = ['image_link'];

    public function getImageLinkAttribute()
    {
        return $this->image ? asset('public/' . $this->image) : null;
    }
}
