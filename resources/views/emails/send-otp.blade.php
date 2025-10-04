<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        /* Reset */
        body, html { margin:0; padding:0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6fa; }
        a { text-decoration: none; }

        /* Container */
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.1); }

        /* Header */
        .header { background: linear-gradient(90deg, #002C51, #004080); color: #fff; text-align: center; padding: 30px 25px; }
        .header h1 { margin: 0; font-size: 28px; letter-spacing: 1px; font-weight: 700; }

        /* Body */
        .body { padding: 40px 30px; text-align: center; color: #333; }
        .body p { font-size: 16px; margin-bottom: 20px; line-height: 1.5; }
        .otp-code { font-size: 48px; font-weight: bold; color: #F07815; margin: 25px 0; letter-spacing: 6px; }
        .note { font-size: 14px; color: #666; margin-top: 25px; line-height: 1.4; }

        /* Button */
        .btn { display: inline-block; margin-top: 30px; background: #F07815; color: #fff; font-weight: 600; padding: 14px 35px; border-radius: 50px; box-shadow: 0 4px 12px rgba(240,120,21,0.3); transition: all 0.3s ease; }
        .btn:hover { background: #d96611; }

        /* Footer */
        .footer { background-color: #f4f6fa; text-align: center; padding: 15px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>AquaRover</h1>
        </div>

        <!-- Body -->
        <div class="body">
            @if($isForgotPassword)
                <p>You requested to reset your password. Use the OTP below to proceed:</p>
            @elseif($isResend)
                <p>You requested a new OTP. Here it is:</p>
            @else
                <p>Your OTP for login/registration is:</p>
            @endif

            <div class="otp-code">{{ $otp }}</div>

            <p class="note">
                This OTP is valid for <strong>2 minutes</strong> only. Do not share it with anyone.
            </p>

            <a href="#" class="btn">Go to AquaRover</a>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} AquaRover. All rights reserved.
        </div>
    </div>
</body>
</html>
