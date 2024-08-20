<!DOCTYPE html>
<html>
<head>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: #ffffff; margin: 20px auto; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <tr>
            <td align="center" style="padding: 10px; background-color: #ffffff;">
                <!-- Ensure the logo URL is absolute and publicly accessible -->
                <img src="{{ asset('public/assets/logo/jobhub-logo.svg') }}" alt="Logo" style="max-width: 100px; height: 100px;">
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <h1 style="margin-top: 20px;">Thank you for contacting us!</h1>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; padding: 20px;">
                <p>We have received your message and will get back to you as soon as possible.</p>
                <p>Here are the details you provided:</p>
                <ul>
                    <!-- Replace these placeholders with your dynamic content variables -->
                    <li><strong>Name:</strong> {{ $details['name'] ?? '' }}</li>
                    <li><strong>Email:</strong> {{ $details['email'] ?? '' }}</li>
                    <li><strong>Phone Number:</strong> {{ $details['telephone'] ?? '' }}</li>
                    <li><strong>Subject:</strong> {{ $details['subject'] ?? '' }}</li>
                    <li><strong>Message:</strong> {{ $details['message'] ?? '' }}</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td align="center" style="font-size: 0.9em; text-align: center; margin-top: 20px;">
                Best regards,<br>JobHub Team
            </td>
        </tr>
    </table>
</body>
</html>
