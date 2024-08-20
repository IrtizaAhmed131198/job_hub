<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HowItWorkController extends Controller
{
    public function howitwork()
    {
        return view('front.howitwork');
    }
}
