<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function dataReg()
    {
        return view("register");
    }

    public function submitRegister(Request $request)
    {
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        return '<h1>SELAMAT DATANG '.$firstName.'&nbsp;'.$lastName.'</h1><br>
        <h2>Terima kasih telah bergabung di Sanberbook. Social Media kita bersama!</h2>';
    }
}
?>
