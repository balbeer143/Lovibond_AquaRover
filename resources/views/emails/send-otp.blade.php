<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin:0; padding:0;">
    <div style="max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        
        <!-- Header -->
        <div style="background: #F07815; color: #fff; text-align: center; padding: 20px;">
            <h1 style="margin: 0; font-size: 24px;">AquaRover</h1>
        </div>

        <!-- Content -->
        <div style="padding: 30px; text-align: center;">
            
            @if($isForgotPassword)
                <p style="color:#333; font-size:16px; margin-bottom:20px;">
                    You requested to reset your password. Please use the OTP below:
                </p>
            @elseif($isResend)
                <p style="color:#333; font-size:16px; margin-bottom:20px;">
                    You requested a new OTP. Here it is:
                </p>
            @else
                <p style="color:#333; font-size:16px; margin-bottom:20px;">
                    Your OTP for login/registration is:
                </p>
            @endif

            <h2 style="font-size: 40px; font-weight: bold; color: #F07815; margin: 20px 0;">
                {{ $otp }}
            </h2>

            <p style="color:#666; font-size:14px; margin-top:30px;">
                This OTP is valid for <strong>10 minutes</strong>.  
                Do not share it with anyone for security reasons.
            </p>
        </div>

        <!-- Footer -->
        <div style="background: #f4f4f4; text-align: center; padding: 15px; font-size: 12px; color: #777;">
            &copy; {{ date('Y') }} AquaRover. All rights reserved.
        </div>
    </div>
</body>
</html>
