<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified']);
    }

    public function dataRegistration()
    {
        return view("registration");
    }

    public function SubmitRegistration(Request $request)
    {
        $firstName = $request->input('first_name'); 
        $lastName = $request->input('last_name');
        return '<h1>SELAMAT DATANG '.$firstName.'&nbsp;'.$lastName.'</h1><br>
        <h2>Terima kasih telah bergabung di Sanberbook. Social Media kita bersama!</h2>';
    }
}
