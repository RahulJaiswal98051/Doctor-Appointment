<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function payment(){
        return view('dashboard.pages.payment');
    }

    public function paymentSubmit(){
        return route('dashboard.user');
    }
}
