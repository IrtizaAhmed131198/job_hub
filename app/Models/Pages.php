<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        'title',
        'sub_title',
        'short_description',
        'long_description',
        'image',
        'page_type',
        'created_at'
    ];

    public function getFirstImageLinkAttribute()
    {
        return $this->image ? asset('public/' . $this->image) : null;
    }

    public function getSecondImageLinkAttribute()
    {
        return $this->banner_image ? asset('public/' . $this->banner_image) : null;
    }
}
