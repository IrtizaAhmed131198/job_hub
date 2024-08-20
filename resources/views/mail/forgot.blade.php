<!DOCTYPE html>
<html>
<head>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: #ffffff; margin: 20px auto; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <tr>
            <td align="center" style="padding: 10px;">
                <!-- Logo goes here; ensure the URL is absolute and publicly accessible -->
                <img src="{{ asset('public/assets/logo/jobhub-logo.svg') }}" alt="Logo" style="max-width: 100px; height: 100px;">
            </td>
        </tr>
        <tr>
            <td align="center" style="text-align: center;">
                <h1 style="margin-top: 20px;">Forgot Your Password?</h1>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; padding: 20px;">
                <h2>Dear {{ $name }},</h2>
                <p>We received a request to reset your password for your account. If you did not make this request, please ignore this email.</p>
                <p>To reset your password, click the button below:</p>
                <!-- Ensure the link is dynamically generated and securely processed -->
                <a href="{{ route('users.reset', ['id' => $user_id]) }}" style="background-color: #4285f4; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block; margin: 20px 0;">Verify</a>
            </td>
        </tr>
        <tr>
            <td align="center" style="font-size: 0.9em; text-align: center; margin-top: 20px;">
                Best regards,<br>Job Hub Team
            </td>
        </tr>
    </table>
</body>
</html>
