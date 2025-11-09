<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BINI Ticket System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="register-page">

    <div class="signup-container">
        <h1>Sign Up</h1>

        <form action="{{ route('register') }}" method="POST" class="signup-form">
            @csrf

            <p>Name</p>
            <input type="text" name="name" required>

            <p>Email</p>
            <input type="email" name="email" required>

            <p>Password</p>
            <input type="password" name="password" required>

            <p>Confirm Password</p>
            <input type="password" name="password_confirmation" required>

            <button type="submit">Sign Up</button>
        </form>

        <p>Already have an account? 
            <a href="{{ route('login.form') }}">Login here</a>
        </p>

        <img src="{{ asset('images/bini-logo.jpg') }}" alt="BINI Logo">
    </div>
</body>
</html>
