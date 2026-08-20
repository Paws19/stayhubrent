<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta name="color-scheme" content="light" />
    <meta name="supported-color-schemes" content="light" />
    <title>Your StayHubRent Verification Code</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        /* ---------- Reset ---------- */
        body,
        table,
        td,
        p,
        h1,
        h2 {
            margin: 0;
            padding: 0;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            background-color: #f2f4f7;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-family: 'DM Sans', Arial, Helvetica, sans-serif;
        }

        img {
            border: 0;
            outline: none;
            text-decoration: none;
            display: block;
        }

        table {
            border-collapse: collapse;
        }

        /* ---------- Layout ---------- */
        .email-outer {
            width: 100%;
            padding: 32px 16px;
            background-color: #f2f4f7;
        }

        .email-card {
            max-width: 480px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e6e8ec;
        }

        /* ---------- Top gradient bar ---------- */
        .top-bar {
            height: 6px;
            background: linear-gradient(90deg, #6d5efc 0%, #8f7dfc 50%, #ff8bd0 100%);
        }

        /* ---------- Header ---------- */
        .email-header {
            padding: 32px 32px 24px 32px;
            text-align: center;
        }

        .brand {
            display: inline-block;
            font-family: 'Syne', Arial, sans-serif;
            font-weight: 800;
            font-size: 18px;
            letter-spacing: -0.3px;
            color: #1c1c28;
            margin-bottom: 22px;
        }

        .brand-dot {
            display: inline-block;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6d5efc, #ff8bd0);
            margin-right: 8px;
            vertical-align: middle;
        }

        .icon-wrap {
            width: 56px;
            height: 56px;
            line-height: 56px;
            border-radius: 50%;
            background: #f1eefe;
            margin: 0 auto 18px auto;
            font-size: 24px;
        }

        .email-title {
            font-family: 'Syne', Arial, sans-serif;
            font-weight: 800;
            font-size: 24px;
            color: #1c1c28;
            margin-bottom: 10px;
        }

        .email-title em {
            color: #6d5efc;
            font-style: normal;
        }

        .email-desc {
            font-size: 14.5px;
            line-height: 22px;
            color: #63677a;
            max-width: 360px;
            margin: 0 auto;
        }

        .email-desc strong {
            color: #1c1c28;
        }

        /* ---------- Body ---------- */
        .email-body {
            padding: 4px 32px 32px 32px;
        }

        /* ---------- OTP block ---------- */
        .otp-block {
            background: linear-gradient(180deg, #f7f6ff 0%, #f1eefe 100%);
            border: 1px solid #e3ddfd;
            border-radius: 14px;
            padding: 24px 20px;
            text-align: center;
            margin-bottom: 24px;
        }

        .otp-label {
            font-size: 12.5px;
            font-weight: 600;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            color: #7a6ff0;
            margin-bottom: 14px;
        }

        .otp-code {
            font-family: 'Syne', Arial, sans-serif;
            font-weight: 800;
            font-size: 36px;
            letter-spacing: 10px;
            color: #1c1c28;
            padding-left: 10px;
            /* optically re-center for letter-spacing */
        }

        .otp-expiry {
            display: inline-block;
            margin-top: 16px;
            font-size: 12.5px;
            font-weight: 600;
            color: #b4562f;
            background: #fdeee5;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .expiry-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #e8783f;
            margin-right: 6px;
            vertical-align: middle;
        }

        /* ---------- Info rows ---------- */
        .info-rows {
            margin-bottom: 8px;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 16px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-icon {
            display: table-cell;
            width: 32px;
            vertical-align: top;
            font-size: 16px;
            padding-top: 1px;
        }

        .info-row p {
            display: table-cell;
            vertical-align: top;
            font-size: 13.5px;
            line-height: 20px;
            color: #63677a;
        }

        .info-row p strong {
            color: #1c1c28;
            font-weight: 600;
        }

        .divider {
            height: 1px;
            background-color: #edeef2;
            margin: 24px 0;
        }

        /* ---------- Security notice ---------- */
        .security-notice {
            display: table;
            width: 100%;
            background: #fff9ec;
            border: 1px solid #f5e6bc;
            border-radius: 12px;
            padding: 14px 16px;
        }

        .sn-icon {
            display: table-cell;
            width: 26px;
            vertical-align: top;
            font-size: 15px;
        }

        .security-notice p {
            display: table-cell;
            vertical-align: top;
            font-size: 12.5px;
            line-height: 19px;
            color: #7a6a3a;
        }

        .security-notice p strong {
            color: #4a3f1e;
        }

        /* ---------- Footer ---------- */
        .email-footer {
            padding: 28px 32px 32px 32px;
            text-align: center;
            background-color: #fafafb;
            border-top: 1px solid #edeef2;
        }

        .footer-brand {
            font-family: 'Syne', Arial, sans-serif;
            font-weight: 700;
            font-size: 13.5px;
            color: #1c1c28;
            margin-bottom: 14px;
        }

        .footer-brand-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #6d5efc;
            margin-right: 6px;
            vertical-align: middle;
        }

        .footer-links {
            margin-bottom: 16px;
        }

        .footer-links a {
            font-size: 12px;
            color: #7a7e8c;
            text-decoration: none;
            margin: 0 8px;
        }

        .footer-links a:hover {
            color: #6d5efc;
        }

        .footer-copy {
            font-size: 11.5px;
            line-height: 18px;
            color: #a2a5b1;
        }

        /* ---------- Mobile ---------- */
        @media only screen and (max-width: 480px) {
            .email-outer {
                padding: 16px 8px;
            }

            .email-card {
                border-radius: 12px;
            }

            .email-header {
                padding: 26px 20px 18px 20px;
            }

            .email-body {
                padding: 4px 20px 26px 20px;
            }

            .email-footer {
                padding: 22px 20px 26px 20px;
            }

            .email-title {
                font-size: 20px;
            }

            .email-desc {
                font-size: 13.5px;
                line-height: 20px;
            }

            .otp-block {
                padding: 20px 12px;
            }

            .otp-code {
                font-size: 28px;
                letter-spacing: 6px;
                padding-left: 6px;
            }

            .footer-links a {
                display: inline-block;
                margin: 4px 6px;
            }
        }
    </style>
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

                    <div class="otp-code">{{ $otp }}</div>

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
                    StayHubRent
                </p>
            </div>

        </div><!-- /email-card -->
    </div><!-- /email-outer -->

</body>

</html>
