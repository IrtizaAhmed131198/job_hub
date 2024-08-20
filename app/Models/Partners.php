<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    use HasFactory;

    protected $table = "partners";

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['image_link'];

    public function getImageLinkAttribute()
    {
        return $this->image ? asset('public/' . $this->image) : null;
    }
}
