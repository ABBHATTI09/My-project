<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h2>Email Verification</h2>
    <p>Click the link below to verify your email:</p>
    <a href="{{ route('email.verify', ['token' => $token]) }}">Verify Email</a>
</body>
</html>
