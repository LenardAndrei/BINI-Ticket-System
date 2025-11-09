<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BINI Ticket System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

    <div class="landing-container">
        <h1>Welcome to the BINI Ticket<br> Selling System </h1>
        <div class="start-button">
            <button onclick="window.location.href='{{ route('events') }}'">Get Started</button>
        </div>    

        <div class="user-button">
            <button onclick="window.location.href='{{ route('register.form') }}'">Sign Up</button>
            <button onclick="window.location.href='{{ route('login.form') }}'">Login</button>
        </div>
    </div>

    <img src="{{ asset('images/bini-logo.jpg') }}" alt="BINI Logo" class="logo-decoration">

    
</body>
</html>
