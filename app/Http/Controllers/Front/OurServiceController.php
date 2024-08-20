<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OurServiceController extends Controller
{
    public function ourservice()
    {
        return view('front.ourservice');
    }
}
