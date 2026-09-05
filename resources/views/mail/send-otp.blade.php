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
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap"
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
            font-family: 'Inter', Arial, Helvetica, sans-serif;
        }

        img,
        svg {
            border: 0;
            outline: none;
            text-decoration: none;
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
            max-width: 440px;
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
            padding: 32px 32px 22px 32px;
            text-align: center;
        }

        .brand {
            display: inline-block;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-weight: 800;
            font-size: 17px;
            letter-spacing: -0.02em;
            color: #1c1c28;
            margin-bottom: 22px;
        }

        .brand-dot {
            display: inline-block;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6d5efc, #ff8bd0);
            margin-right: 7px;
            vertical-align: middle;
        }

        /* Icon circle — houses a clean line-style SVG instead of an emoji */
        .icon-wrap {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: #f1eefe;
            margin: 0 auto 18px auto;
            text-align: center;
            line-height: 54px;
        }

        .icon-wrap svg {
            vertical-align: middle;
        }

        .email-title {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-weight: 800;
            font-size: 22px;
            letter-spacing: -0.01em;
            color: #1c1c28;
            margin-bottom: 8px;
        }

        .email-title em {
            color: #6d5efc;
            font-style: normal;
        }

        .email-desc {
            font-size: 14px;
            line-height: 21px;
            color: #63677a;
            max-width: 320px;
            margin: 0 auto;
        }

        /* ---------- Body ---------- */
        .email-body {
            padding: 4px 32px 28px 32px;
        }

        /* ---------- OTP block ---------- */
        .otp-block {
            background: linear-gradient(180deg, #f7f6ff 0%, #f1eefe 100%);
            border: 1px solid #e3ddfd;
            border-radius: 14px;
            padding: 24px 16px;
            text-align: center;
            margin-bottom: 22px;
        }

        .otp-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            color: #7a6ff0;
            margin-bottom: 16px;
        }

        /* Segmented digit "boxes" — table-based for email-client reliability */
        .otp-digits {
            margin: 0 auto;
        }

        .otp-digit {
            width: 38px;
            height: 48px;
            background: #ffffff;
            border: 1.5px solid #d9d0fb;
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-weight: 800;
            font-size: 22px;
            color: #1c1c28;
            text-align: center;
            vertical-align: middle;
        }

        .otp-digit-gap {
            width: 6px;
        }

        .otp-expiry {
            display: inline-block;
            margin-top: 16px;
            font-size: 12px;
            font-weight: 600;
            color: #b4562f;
            background: #fdeee5;
            padding: 6px 14px;
            border-radius: 20px;
            vertical-align: middle;
        }

        .otp-expiry svg {
            vertical-align: -2px;
            margin-right: 5px;
        }

        /* ---------- CTA button ---------- */
        .cta-wrap {
            text-align: center;
            margin-bottom: 22px;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(90deg, #6d5efc 0%, #8f7dfc 100%);
            color: #ffffff !important;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 10px;
        }

        /* ---------- Info line ---------- */
        .info-line {
            font-size: 13px;
            line-height: 20px;
            color: #63677a;
            text-align: center;
            margin-bottom: 22px;
        }

        .info-line strong {
            color: #1c1c28;
            font-weight: 600;
        }

        .divider {
            height: 1px;
            background-color: #edeef2;
            margin: 4px 0 20px 0;
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
            width: 28px;
            vertical-align: top;
        }

        .sn-icon svg {
            margin-top: 1px;
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
            padding: 26px 32px 30px 32px;
            text-align: center;
            background-color: #fafafb;
            border-top: 1px solid #edeef2;
        }

        .footer-brand {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-weight: 700;
            font-size: 13px;
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
            font-size: 11.5px;
            color: #7a7e8c;
            text-decoration: none;
            margin: 0 8px;
        }

        .footer-links a:hover {
            color: #6d5efc;
        }

        .footer-copy {
            font-size: 11px;
            line-height: 17px;
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
                padding: 4px 20px 24px 20px;
            }

            .email-footer {
                padding: 22px 20px 26px 20px;
            }

            .email-title {
                font-size: 19px;
            }

            .email-desc {
                font-size: 13px;
                line-height: 19px;
            }

            .otp-block {
                padding: 20px 8px;
            }

            .otp-digit {
                width: 30px;
                height: 40px;
                font-size: 18px;
            }

            .otp-digit-gap {
                width: 4px;
            }

            .footer-links a {
                display: inline-block;
                margin: 3px 6px;
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

                <!-- Shield-check icon (replaces 🔐 emoji) -->
                <div class="icon-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6d5efc"
                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3l7 3v5c0 4.6-2.98 8.66-7 10-4.02-1.34-7-5.4-7-10V6l7-3Z" />
                        <path d="M9 12l2 2 4-4" />
                    </svg>
                </div>

                <h1 class="email-title">Verify it's <em>you</em></h1>
                <p class="email-desc">
                    Enter this code to finish setting up your StayHubRent account.
                </p>
            </div>

            <!-- BODY -->
            <div class="email-body">

                <!-- OTP BLOCK -->
                <div class="otp-block">
                    <p class="otp-label">Your verification code</p>

                    <table class="otp-digits" role="presentation" cellpadding="0" cellspacing="0" align="center">
                        <tr>
                            @foreach (str_split((string) $otp) as $i => $digit)
                                @if ($i > 0)
                                    <td class="otp-digit-gap"></td>
                                @endif
                                <td class="otp-digit">{{ $digit }}</td>
                            @endforeach
                        </tr>
                    </table>

                    <span class="otp-expiry">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#b4562f"
                            stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                            style="display:inline-block;">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7v5l3 3" />
                        </svg>
                        Expires in 10 minutes
                    </span>
                </div>

                <!-- CTA -->
                <div class="cta-wrap">
                    <a href="{{ route('index') }}" class="cta-button">Return to StayHubRent →</a>
                </div>

                <p class="info-line">
                    Didn't request this code? You can safely ignore this email —
                    <strong>your account is secure.</strong>
                </p>

                <div class="divider"></div>

                <!-- SECURITY NOTICE -->
                <div class="security-notice">
                    <span class="sn-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#b4562f"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 9v4" />
                            <path d="M12 17h.01" />
                            <path
                                d="M10.29 3.86 1.82 18a1.5 1.5 0 0 0 1.29 2.25h17.78A1.5 1.5 0 0 0 22.18 18L13.71 3.86a1.5 1.5 0 0 0-2.42 0Z" />
                        </svg>
                    </span>
                    <p><strong>Never share this code.</strong> StayHubRent will never ask for it by phone, chat, or
                        email.</p>
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
                </div>
                <p class="footer-copy">
                    © {{ date('Y') }} StayHubRent. All rights reserved.<br />
                    This is an automated message — please do not reply directly to this email.
                </p>
            </div>

        </div><!-- /email-card -->
    </div><!-- /email-outer -->

</body>

</html>
