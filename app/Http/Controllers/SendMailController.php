<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendMailController extends Controller
{
    function index()
    {
     return view('send_email');
    }
}
