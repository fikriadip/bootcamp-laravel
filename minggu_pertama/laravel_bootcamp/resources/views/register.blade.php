<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
</head>
<body class="antialiased">
    <form action="{{route('welcome.submit')}}" method="POST">
        @csrf
    <h2>Buat Account Baru!</h2>
    <h4>Sign Up Form</h4>
    <label for="name">First name:</label>
    <br>
    <br>
    <input type="text" id="name" name="first_name">
    <br>
    <br>
    <label for="lastname">Last name:</label>
    <br>
    <br>
    <input type="text" id="lastname" name="last_name">
    <br>
    <p>Gender:</p>
    <input type="radio" name="gender" id="male">
    <label for="male">Male</label>
    <br>
    <input type="radio" name="gender" id="female">
    <label for="female">Female</label>
    <br>
    <input type="radio" name="gender" id="other">
    <label for="other">Other</label>
    <br>
    <p>Nationality:</p>
    <select>
        <option value="">Indonesia</option>
        <option value="">Singapura</option>
        <option value="">Malaysia</option>
        <option value="">Australian</option>
    </select>
    <p>Language Spoken:</p>
    <input type="checkbox" id="idn">
    <label for="idn">Bahasa Indonesia</label>
    <br>
    <input type="checkbox" id="english">
    <label for="english">English</label>
    <br>
    <input type="checkbox" id="dont">
    <label for="dont">Other</label>
    <p>Bio:</p>
    <textarea cols="30" rows="10"></textarea>
    <br>
    <input type="submit" value="Sign Up">

    </form>
</body>
</html>