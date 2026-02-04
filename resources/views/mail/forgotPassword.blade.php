<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
</head>
<body>
    <h2>Hello Sir</h2>

    <p>You requested to reset your password. Click the button below to reset it:</p>

    <p>
        <a href="{{ route('reset.password', ['token' => $token, 'email' => $email]) }}" 
           style="display:inline-block;padding:10px 20px;background:#3490dc;color:#fff;text-decoration:none;border-radius:5px;">
            Reset Password
        </a>
    </p>

    <p>If you did not request a password reset, no further action is required.</p>

    <p>Thanks,<br>
</body>
</html>
