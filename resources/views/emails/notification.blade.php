<!DOCTYPE html>
<html>
<head>
    <title>Allo Maalem Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #1f2937; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">Allo Maalem</h2>

        <p style="color: #4b5563; font-size: 16px; line-height: 1.5;">
            {{ $messageText }}
        </p>

        <p style="color: #9ca3af; font-size: 12px; margin-top: 30px; text-align: center;">
            &copy; {{ date('Y') }} Allo Maalem. All rights reserved.
        </p>
    </div>
</body>
</html>
