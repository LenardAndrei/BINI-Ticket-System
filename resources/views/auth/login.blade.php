<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BINI Ticket System - Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="register-page">

    <div class="signup-container">
        <h1>Login</h1>

        <!-- Show error message if login fails -->
        @if($errors->any())
            <div class="error-message">
                <p style="color: red;">{{ $errors->first() }}</p>
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('login') }}" method="POST" class="signup-form">
            @csrf
            
            <p>Email</p>
            <input type="email" name="email" placeholder="Enter your email" required>
            
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>
        </form>

        <p>Don’t have an account?
            <a href="{{ route('register.form') }}">Sign Up here</a>
        </p>

        <img src="{{ asset('images/bini-logo.jpg') }}" alt="BINI Logo">
    </div>

</body>
</html>
