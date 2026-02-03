<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\welcomeEmail;

class MailController extends Controller
{
    public function welcomeMail()
    {
        $to='jaiswalrahul1126@gmail.com';
        $subject='Test Mail';
        $body='This is a test mail';
        Mail::to($to)->send(new welcomeEmail($subject,$body));
    
        return 'Email Sent';
    }
}
