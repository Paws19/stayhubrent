<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="x-apple-disable-message-reformatting" />
    <title>Your StayHubRent Verification Code</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/send-otp.css') }}" />
</head>

<body>

    <div class="email-outer">
        <div class="email-card">

            <!-- TOP GRADIENT BAR -->
            <div class="top-bar"></div>

            <!-- HEADER -->
            <div class="email-header">
                <div class="brand">
                    <span class="brand-dot"></span>StayHubRent
                </div>

                <div class="icon-wrap">
                    <span>🔐</span>
                </div>

                <h1 class="email-title">Verify it's <em>you</em></h1>
                <p class="email-desc">
                    Use the one-time code below to complete your sign-up on StayHubRent.
                    This code is valid for <strong>10 minutes</strong> only — do not share it with anyone.
                </p>
            </div>

            <!-- BODY -->
            <div class="email-body">

                <!-- OTP BLOCK -->
                <div class="otp-block">
                    <p class="otp-label">Your 6-digit verification code</p>

                    <div class="otp-digits">
                        <div class="otp-digit">{{ $otp }}</div>

                    </div>

                    <div class="otp-expiry">
                        <span class="expiry-dot"></span>
                        Expires in 10 minutes
                    </div>
                </div>

                <!-- INFO ROWS -->
                <div class="info-rows">
                    <div class="info-row">
                        <span class="info-icon">📱</span>
                        <p>Go back to the <strong>StayHubRent sign-up page</strong> and enter this code in the
                            verification field to activate your account.</p>
                    </div>
                    <div class="info-row">
                        <span class="info-icon">⏱️</span>
                        <p>This code <strong>expires in 10 minutes.</strong> If it expires, return to the sign-up page
                            and click <strong>Resend Code</strong> to get a new one.</p>
                    </div>
                    <div class="info-row">
                        <span class="info-icon">📍</span>
                        <p>Request originated from <strong>Philippines (PH)</strong>. If this wasn't you, no action is
                            needed — your account is safe.</p>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- SECURITY NOTICE -->
                <div class="security-notice">
                    <span class="sn-icon">⚠️</span>
                    <p><strong>Didn't request this?</strong> If you did not sign up for StayHubRent, simply ignore this
                        email. We will never ask for your password or personal details via email.</p>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="email-footer">
                <div class="footer-brand">
                    <span class="footer-brand-dot"></span>StayHubRent
                </div>
                <div class="footer-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Help Center</a>
                    <a href="#">Unsubscribe</a>
                </div>
                <p class="footer-copy">
                    © 2025 StayHubRent. All rights reserved.<br />
                    This is an automated message — please do not reply directly to this email.<br />
                    StayHubRent · Metro Manila, Philippines
                </p>
            </div>

        </div><!-- /email-card -->
    </div><!-- /email-outer -->

</body>

</html>
