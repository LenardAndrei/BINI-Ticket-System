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
        <h1>Login</h1>

        <div class="signup-form">
            
            <p>Email</p>
            <input type="email" id="email-input" name="email" placeholder="">
            
            <p>Password</p>
            <input type="password" id="password-input" name="password" placeholder="">

            <button onclick="window.location.href='{{ route('events') }}'">Login</button>
       
        </div>
        

        <img src="{{ asset('images/bini-logo.jpg') }}" alt="BINI Logo" >
    </div>

    
    
</body>
</html>
