<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>StayHubRent — Get Started</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap"
        rel="stylesheet" />
    <style>
        /* ── TOKENS ── */
        :root {
            --ease: cubic-bezier(.25, .8, .25, 1);
            --spring: cubic-bezier(.34, 1.56, .64, 1);
        }

        [data-theme="dark"] {
            --bg: #0c0e14;
            --bg2: #13151e;
            --surface: #181b27;
            --card: #1f2232;
            --border: rgba(255, 255, 255, .08);
            --border2: rgba(255, 255, 255, .14);
            --text: #e8eaf0;
            --sub: #a0a5c0;
            --muted: #636882;
            --accent: #6c9aff;
            --accent2: #5effd3;
            --accent3: #ff7eb3;
            --glow: rgba(108, 154, 255, .2);
            --glow2: rgba(94, 255, 211, .15);
            --err: #ff6b6b;
            --nav-bg: rgba(12, 14, 20, .88);
        }

        [data-theme="light"] {
            --bg: #f0f2fb;
            --bg2: #e6e9f7;
            --surface: #ffffff;
            --card: #ffffff;
            --border: rgba(0, 0, 0, .08);
            --border2: rgba(0, 0, 0, .14);
            --text: #1a1d2e;
            --sub: #5a5f7a;
            --muted: #9297b2;
            --accent: #3a6ff0;
            --accent2: #00b890;
            --accent3: #e0487c;
            --glow: rgba(58, 111, 240, .15);
            --glow2: rgba(0, 184, 144, .12);
            --err: #d63b3b;
            --nav-bg: rgba(240, 242, 251, .9);
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
            transition: background .4s, color .4s;
        }

        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 3rem;
            background: var(--nav-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            transition: background .4s;
        }

        .nav-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: .45rem;
        }

        .logo-pip {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--accent);
            display: inline-block;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-back {
            font-size: .88rem;
            font-weight: 500;
            color: var(--sub);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: .4rem;
            transition: .2s;
        }

        .nav-back:hover {
            color: var(--text);
        }

        .theme-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--surface);
            border: 1px solid var(--border);
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .2s;
        }

        .theme-btn:hover {
            border-color: var(--accent);
        }

        /* ── LAYOUT ── */
        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        /* background orbs */
        .page-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            pointer-events: none;
            z-index: 0;
        }

        .page-orb1 {
            width: 500px;
            height: 500px;
            background: var(--accent);
            opacity: .07;
            top: -100px;
            left: -120px;
        }

        .page-orb2 {
            width: 400px;
            height: 400px;
            background: var(--accent2);
            opacity: .06;
            bottom: -80px;
            right: -80px;
        }

        .page-orb3 {
            width: 280px;
            height: 280px;
            background: var(--accent3);
            opacity: .05;
            top: 50%;
            left: 60%;
        }

        /* grid overlay on body */
        .page::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: linear-gradient(var(--border) 1px, transparent 1px), linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 55px 55px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 40%, black, transparent);
            pointer-events: none;
        }

        /* RIGHT PANEL (now the only panel) */
        .right-panel {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 7rem 1.5rem 5rem;
            position: relative;
            z-index: 1;
        }

        .form-shell {
            width: 100%;
            max-width: 520px;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeUp .6s var(--spring) both;
        }

        .page-badge {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .35rem .9rem;
            border-radius: 50px;
            background: var(--surface);
            border: 1px solid var(--border);
            font-size: .78rem;
            font-weight: 500;
            color: var(--sub);
            margin-bottom: 1.1rem;
        }

        .badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent2);
            display: inline-block;
            animation: blink 2s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .3
            }
        }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.8rem, 3vw, 2.4rem);
            font-weight: 800;
            letter-spacing: -.02em;
            margin-bottom: .4rem;
        }

        .page-sub {
            font-size: .95rem;
            color: var(--sub);
        }

        /* ── FORM CARD ── */
        .form-card {
            width: 100%;
            max-width: 520px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.2rem 2.4rem 2.4rem;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .15);
            animation: fadeUp .6s .1s var(--spring) both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* ── STEP INDICATOR ── */
        .steps-indicator {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: 2.5rem;
        }

        .si-step {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .8rem;
            font-weight: 500;
            color: var(--muted);
            transition: .3s;
        }

        .si-step.active {
            color: var(--accent);
        }

        .si-step.done {
            color: var(--accent2);
        }

        .si-num {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            background: var(--surface);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 700;
            transition: .3s;
        }

        .si-step.active .si-num {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .si-step.done .si-num {
            background: var(--accent2);
            border-color: var(--accent2);
            color: #0c0e14;
        }

        .si-line {
            flex: 1;
            height: 1px;
            background: var(--border);
            transition: .3s;
        }

        .si-line.done {
            background: var(--accent2);
        }

        /* ── FORM HEADER ── */
        .form-head {
            margin-bottom: 2rem;
        }

        .form-head h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.9rem;
            font-weight: 800;
            letter-spacing: -.02em;
            margin-bottom: .4rem;
        }

        .form-head p {
            font-size: .93rem;
            color: var(--sub);
        }

        /* ── STEP SLIDES ── */
        .step-slide {
            display: none;
            animation: slideIn .4s var(--spring) both;
        }

        .step-slide.active {
            display: block;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(22px)
            }

            to {
                opacity: 1;
                transform: translateX(0)
            }
        }

        /* ── ROLE PICKER ── */
        .role-picker {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .role-option {
            background: var(--surface);
            border: 2px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem 1.2rem;
            cursor: pointer;
            transition: .25s var(--ease);
            text-align: center;
            position: relative;
        }

        .role-option:hover {
            border-color: var(--border2);
            transform: translateY(-3px);
        }

        .role-option.selected {
            border-color: var(--accent);
            background: rgba(108, 154, 255, .06);
            box-shadow: 0 0 28px var(--glow);
        }

        .role-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .role-emoji {
            font-size: 2rem;
            display: block;
            margin-bottom: .75rem;
        }

        .role-option h3 {
            font-family: 'Syne', sans-serif;
            font-size: .95rem;
            font-weight: 700;
            margin-bottom: .3rem;
        }

        .role-option p {
            font-size: .78rem;
            color: var(--sub);
            line-height: 1.4;
        }

        .role-check {
            position: absolute;
            top: .6rem;
            right: .6rem;
            width: 20px;
            height: 20px;
            border-radius: 6px;
            background: var(--accent);
            display: none;
            align-items: center;
            justify-content: center;
            font-size: .65rem;
            color: #fff;
        }

        .role-option.selected .role-check {
            display: flex;
        }

        /* ── FORM FIELDS ── */
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: .4rem;
        }

        .field label {
            font-size: .82rem;
            font-weight: 600;
            color: var(--sub);
            letter-spacing: .03em;
        }

        .field label span {
            color: var(--accent3);
        }

        .field input,
        .field select,
        .field textarea {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: .8rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: .93rem;
            color: var(--text);
            transition: .25s;
            outline: none;
            width: 100%;
        }

        .field input::placeholder,
        .field textarea::placeholder {
            color: var(--muted);
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--glow);
        }

        .field select option {
            background: var(--surface);
            color: var(--text);
        }

        .field textarea {
            resize: vertical;
            min-height: 90px;
        }

        .field-hint {
            font-size: .75rem;
            color: var(--muted);
            margin-top: .15rem;
        }

        /* password wrapper */
        .pw-wrap {
            position: relative;
        }

        .pw-wrap input {
            padding-right: 3rem;
        }

        .pw-eye {
            position: absolute;
            right: .9rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            color: var(--muted);
            padding: .2rem;
        }

        /* strength bar */
        .strength-bar {
            display: flex;
            gap: .25rem;
            margin-top: .5rem;
        }

        .strength-seg {
            flex: 1;
            height: 3px;
            border-radius: 3px;
            background: var(--surface);
            transition: .3s;
        }

        /* checkbox */
        .check-field {
            display: flex;
            align-items: flex-start;
            gap: .7rem;
            cursor: pointer;
        }

        .check-field input[type="checkbox"] {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            margin-top: 2px;
            accent-color: var(--accent);
            cursor: pointer;
        }

        .check-field span {
            font-size: .85rem;
            color: var(--sub);
            line-height: 1.5;
        }

        .check-field a {
            color: var(--accent);
            text-decoration: none;
        }

        /* ── LANDLORD SPECIFIC ── */
        .property-hint {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            margin-bottom: 1.5rem;
            display: flex;
            gap: .8rem;
            align-items: flex-start;
        }

        .property-hint .pi {
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .property-hint p {
            font-size: .83rem;
            color: var(--sub);
            line-height: 1.55;
        }

        .property-hint strong {
            color: var(--text);
            font-size: .85rem;
        }

        /* tag pills */
        .amenity-grid {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin-top: .5rem;
        }

        .amenity-pill {
            padding: .35rem .85rem;
            border-radius: 50px;
            border: 1px solid var(--border);
            background: var(--surface);
            font-size: .8rem;
            color: var(--sub);
            cursor: pointer;
            transition: .2s;
        }

        .amenity-pill:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .amenity-pill.on {
            background: rgba(108, 154, 255, .1);
            border-color: var(--accent);
            color: var(--accent);
        }

        /* ── VERIFY STEP ── */
        .verify-box {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .verify-icon {
            font-size: 3rem;
            display: block;
            margin-bottom: 1rem;
        }

        .verify-box h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: .5rem;
        }

        .verify-box p {
            font-size: .88rem;
            color: var(--sub);
            line-height: 1.6;
            margin-bottom: 1.2rem;
        }

        .otp-wrap {
            display: flex;
            gap: .6rem;
            justify-content: center;
            margin: 1.2rem 0;
        }

        .otp-wrap input {
            width: 46px;
            height: 52px;
            border-radius: 11px;
            background: var(--bg2);
            border: 1px solid var(--border);
            text-align: center;
            font-size: 1.3rem;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            color: var(--text);
            outline: none;
            transition: .2s;
        }

        .otp-wrap input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--glow);
        }

        .resend {
            font-size: .82rem;
            color: var(--muted);
        }

        .resend a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        /* summary card */
        .summary-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.2rem 1.4rem;
            margin-bottom: 1.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .5rem 0;
            border-bottom: 1px solid var(--border);
            font-size: .88rem;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-row span {
            color: var(--sub);
        }

        .summary-row strong {
            color: var(--text);
        }

        .summary-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: rgba(94, 255, 211, .1);
            color: var(--accent2);
            padding: .2rem .7rem;
            border-radius: 50px;
            font-size: .75rem;
            font-weight: 700;
        }

        /* ── BUTTONS ── */
        .btn-full {
            width: 100%;
            padding: .9rem;
            border-radius: 12px;
            border: none;
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            background: var(--accent);
            color: #fff;
            cursor: pointer;
            box-shadow: 0 0 28px var(--glow);
            transition: .25s var(--ease);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
        }

        .btn-full:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 36px var(--glow);
        }

        .btn-back {
            width: 100%;
            padding: .85rem;
            border-radius: 12px;
            background: transparent;
            border: 1px solid var(--border);
            font-family: 'DM Sans', sans-serif;
            font-size: .95rem;
            font-weight: 500;
            color: var(--sub);
            cursor: pointer;
            transition: .2s;
            margin-bottom: .75rem;
        }

        .btn-back:hover {
            border-color: var(--border2);
            color: var(--text);
        }

        /* ── OR DIVIDER ── */
        .or-line {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin: 1.2rem 0;
            color: var(--muted);
            font-size: .82rem;
        }

        .or-line::before,
        .or-line::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* social btns */
        .social-btns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .75rem;
            margin-bottom: 1.2rem;
        }

        .social-btn {
            padding: .75rem;
            border-radius: 11px;
            border: 1px solid var(--border);
            background: var(--surface);
            font-size: .88rem;
            font-weight: 500;
            color: var(--text);
            cursor: pointer;
            transition: .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }

        .social-btn:hover {
            border-color: var(--border2);
        }

        .signin-link {
            text-align: center;
            font-size: .85rem;
            color: var(--sub);
            margin-top: 1rem;
        }

        .signin-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        /* ── SUCCESS ── */
        .success-screen {
            display: none;
            text-align: center;
            padding: 2rem 0;
        }

        .success-screen.show {
            display: block;
            animation: fadeUp .5s var(--spring) both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .success-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: rgba(94, 255, 211, .12);
            border: 1px solid var(--accent2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
        }

        .success-screen h2 {
            font-family: 'Syne', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: .6rem;
        }

        .success-screen p {
            font-size: .95rem;
            color: var(--sub);
            line-height: 1.6;
            max-width: 360px;
            margin: 0 auto 2rem;
        }

        .next-steps {
            display: flex;
            flex-direction: column;
            gap: .6rem;
            text-align: left;
            margin-bottom: 2rem;
        }

        .ns-item {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: .9rem 1.1rem;
            display: flex;
            align-items: center;
            gap: .8rem;
            font-size: .88rem;
        }

        .ns-num {
            width: 26px;
            height: 26px;
            border-radius: 7px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav>
        <a href="{{ route('index') }}" class="nav-logo"><span class="logo-pip"></span>StayHubRent</a>
        <div class="nav-right">
            <a href="{{ route('index') }}" class="nav-back">← Back to Home</a>
            <button class="theme-btn" id="themeBtn" title="Toggle theme">🌙</button>
        </div>
    </nav>

    <!-- PAGE -->
    <div class="page">
        <div class="page-orb page-orb1"></div>
        <div class="page-orb page-orb2"></div>
        <div class="page-orb page-orb3"></div>

        <!-- FORM PANEL -->
        <div class="right-panel">

            <!-- Page header -->
            <div class="page-header">
                <div class="page-badge"><span class="badge-dot"></span>Free to join · No credit card needed</div>
                <h1 class="page-title">Create your account</h1>
                <p class="page-sub">Join thousands managing rentals smarter with StayHubRent</p>
            </div>

            <div class="form-card">
                <div class="form-shell" id="formShell">

                    <!-- STEP INDICATOR -->
                    <div class="steps-indicator" id="stepIndicator">
                        <div class="si-step active" id="si1">
                            <div class="si-num">1</div>
                            <span>Role</span>
                        </div>
                        <div class="si-line" id="sl1"></div>
                        <div class="si-step" id="si2">
                            <div class="si-num">2</div>
                            <span>Account</span>
                        </div>
                        <div class="si-line" id="sl2"></div>
                        <div class="si-step" id="si3">
                            <div class="si-num">3</div>
                            <span>Details</span>
                        </div>
                        <div class="si-line" id="sl3"></div>
                        <div class="si-step" id="si4">
                            <div class="si-num">4</div>
                            <span>Confirm</span>
                        </div>
                    </div>

                    <!-- ═══ STEP 1: ROLE ═══ -->
                    <div class="step-slide active" id="step1">
                        <div class="form-head">
                            <h1>Choose your role</h1>
                            <p>How will you be using StayHubRent?</p>
                        </div>

                        <div class="role-picker">
                            <label class="role-option" id="roleLandlord" onclick="selectRole('landlord')">
                                <input type="radio" name="role" value="landlord" />
                                <div class="role-check">✓</div>
                                <span class="role-emoji">🏡</span>
                                <h3>Landlord</h3>
                                <p>I own or manage a boarding house / apartment</p>
                            </label>
                            <label class="role-option" id="roleTenant" onclick="selectRole('tenant')">
                                <input type="radio" name="role" value="tenant" />
                                <div class="role-check">✓</div>
                                <span class="role-emoji">🙋</span>
                                <h3>Tenant</h3>
                                <p>I'm looking for a room or bed space to rent</p>
                            </label>
                        </div>

                        <!-- Dynamic role info -->
                        <div id="roleInfo"
                            style="background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.1rem 1.3rem;margin-bottom:1.5rem;display:none;font-size:.85rem;color:var(--sub);line-height:1.6;">
                        </div>

                        <button class="btn-full" onclick="goStep(2)" id="btnStep1" disabled>
                            Continue <span>→</span>
                        </button>
                        <div class="or-line">or sign up with</div>
                        <div class="social-btns">
                            <button class="social-btn">🇬 Google</button>
                            <button class="social-btn">🍎 Apple</button>
                        </div>
                        <p class="signin-link">Already have an account? <a href="#">Sign in</a></p>
                    </div>

                    <!-- ═══ STEP 2: ACCOUNT ═══ -->
                    <div class="step-slide" id="step2">
                        <div class="form-head">
                            <h1 id="s2title">Create account</h1>
                            <p id="s2sub">Set up your login credentials</p>
                        </div>

                        <div class="field-group">
                            <div class="field-row">
                                <div class="field">
                                    <label>First Name <span>*</span></label>
                                    <input type="text" placeholder="Juan" id="firstName" />
                                </div>
                                <div class="field">
                                    <label>Last Name <span>*</span></label>
                                    <input type="text" placeholder="dela Cruz" id="lastName" />
                                </div>
                            </div>
                            <div class="field">
                                <label>Email Address <span>*</span></label>
                                <input type="email" placeholder="juan@email.com" id="emailInput" />
                            </div>
                            <div class="field">
                                <label>Phone Number <span>*</span></label>
                                <input type="tel" placeholder="+63 9XX XXX XXXX" id="phoneInput" />
                            </div>
                            <div class="field">
                                <label>Password <span>*</span></label>
                                <div class="pw-wrap">
                                    <input type="password" placeholder="Min. 8 characters" id="pwInput"
                                        oninput="checkStrength()" />
                                    <button class="pw-eye" onclick="togglePw('pwInput',this)"
                                        type="button">👁</button>
                                </div>
                                <div class="strength-bar">
                                    <div class="strength-seg" id="seg1"></div>
                                    <div class="strength-seg" id="seg2"></div>
                                    <div class="strength-seg" id="seg3"></div>
                                    <div class="strength-seg" id="seg4"></div>
                                </div>
                                <p class="field-hint" id="strengthLabel">Enter a password</p>
                            </div>
                            <div class="field">
                                <label>Confirm Password <span>*</span></label>
                                <div class="pw-wrap">
                                    <input type="password" placeholder="Re-enter password" id="pw2Input" />
                                    <button class="pw-eye" onclick="togglePw('pw2Input',this)"
                                        type="button">👁</button>
                                </div>
                            </div>
                            <label class="check-field">
                                <input type="checkbox" id="termsCheck" />
                                <span>I agree to the <a href="#">Terms of Service</a> and <a
                                        href="#">Privacy Policy</a></span>
                            </label>
                        </div>

                        <button class="btn-back" onclick="goStep(1)">← Back</button>
                        <button class="btn-full" onclick="goStep(3)">Continue →</button>
                        <p class="signin-link" style="margin-top:.8rem;">Already have an account? <a
                                href="#">Sign in</a></p>
                    </div>

                    <!-- ═══ STEP 3: DETAILS ═══ -->
                    <!-- LANDLORD DETAILS -->
                    <div class="step-slide" id="step3landlord">
                        <div class="form-head">
                            <h1>Property Details</h1>
                            <p>Tell us about your boarding house</p>
                        </div>

                        <div class="property-hint">
                            <span class="pi">💡</span>
                            <div>
                                <strong>You can add more properties later.</strong>
                                <p>Just fill in your first property below to get started.</p>
                            </div>
                        </div>

                        <div class="field-group">
                            <div class="field">
                                <label>Property Name <span>*</span></label>
                                <input type="text" placeholder="e.g. Sunshine Dormitory" />
                            </div>
                            <div class="field">
                                <label>Property Type <span>*</span></label>
                                <select>
                                    <option value="">Select type...</option>
                                    <option>Boarding House</option>
                                    <option>Apartment</option>
                                    <option>Dormitory</option>
                                    <option>Bed Space</option>
                                    <option>Studio Unit</option>
                                </select>
                            </div>
                            <div class="field-row">
                                <div class="field">
                                    <label>Number of Floors</label>
                                    <input type="number" placeholder="e.g. 3" min="1" />
                                </div>
                                <div class="field">
                                    <label>Number of Rooms <span>*</span></label>
                                    <input type="number" placeholder="e.g. 10" min="1" />
                                </div>
                            </div>
                            <div class="field-row">
                                <div class="field">
                                    <label>Beds per Room <span>*</span></label>
                                    <input type="number" placeholder="e.g. 4" min="1" />
                                </div>
                                <div class="field">
                                    <label>Monthly Rent (₱) <span>*</span></label>
                                    <input type="number" placeholder="e.g. 3500" />
                                </div>
                            </div>
                            <div class="field">
                                <label>Full Address <span>*</span></label>
                                <input type="text" placeholder="Street, Barangay, City" />
                            </div>
                            <div class="field">
                                <label>Amenities</label>
                                <p class="field-hint" style="margin-bottom:.4rem;">Select all that apply</p>
                                <div class="amenity-grid">
                                    <span class="amenity-pill" onclick="togglePill(this)">📶 WiFi</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">❄️ Aircon</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🌀 Electric Fan</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🚿 Private CR</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🚿 Shared CR</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🍳 Kitchen</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🧺 Laundry Area</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">📺 TV</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🔐 CCTV</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🚗 Parking</span>
                                </div>
                            </div>
                            <div class="field">
                                <label>Description / House Rules</label>
                                <textarea placeholder="e.g. No smoking, visitors until 9pm only, quiet hours after 10pm..."></textarea>
                            </div>
                        </div>

                        <button class="btn-back" onclick="goStep(2)">← Back</button>
                        <button class="btn-full" onclick="goStep(4)">Continue →</button>
                    </div>

                    <!-- TENANT DETAILS -->
                    <div class="step-slide" id="step3tenant">
                        <div class="form-head">
                            <h1>Your Preferences</h1>
                            <p>Help us find the right room for you</p>
                        </div>

                        <div class="field-group">
                            <div class="field">
                                <label>Date of Birth <span>*</span></label>
                                <input type="date" />
                            </div>
                            <div class="field">
                                <label>Gender</label>
                                <select>
                                    <option value="">Select...</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Prefer not to say</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Occupation / School</label>
                                <input type="text" placeholder="e.g. UST Student / Call Center Agent" />
                            </div>
                            <div class="field">
                                <label>Preferred Location <span>*</span></label>
                                <input type="text" placeholder="e.g. Quezon City, Pasig, Mandaluyong" />
                            </div>
                            <div class="field-row">
                                <div class="field">
                                    <label>Min Budget (₱)</label>
                                    <input type="number" placeholder="e.g. 2000" />
                                </div>
                                <div class="field">
                                    <label>Max Budget (₱) <span>*</span></label>
                                    <input type="number" placeholder="e.g. 5000" />
                                </div>
                            </div>
                            <div class="field">
                                <label>Room Type Preference</label>
                                <select>
                                    <option value="">Any type</option>
                                    <option>Private Room</option>
                                    <option>Shared Room</option>
                                    <option>Bed Space</option>
                                    <option>Studio Unit</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Must-Have Amenities</label>
                                <div class="amenity-grid">
                                    <span class="amenity-pill" onclick="togglePill(this)">📶 WiFi</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">❄️ Aircon</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🚿 Private CR</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🍳 Kitchen</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🧺 Laundry</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🔐 CCTV</span>
                                    <span class="amenity-pill" onclick="togglePill(this)">🚗 Parking</span>
                                </div>
                            </div>
                            <div class="field">
                                <label>Emergency Contact Name <span>*</span></label>
                                <input type="text" placeholder="Full name" />
                            </div>
                            <div class="field">
                                <label>Emergency Contact Number <span>*</span></label>
                                <input type="tel" placeholder="+63 9XX XXX XXXX" />
                            </div>
                        </div>

                        <button class="btn-back" onclick="goStep(2)">← Back</button>
                        <button class="btn-full" onclick="goStep(4)">Continue →</button>
                    </div>

                    <!-- ═══ STEP 4: CONFIRM ═══ -->
                    <div class="step-slide" id="step4">
                        <div class="form-head">
                            <h1>Almost there!</h1>
                            <p>Review your information before creating your account</p>
                        </div>

                        <div class="summary-card" id="summaryCard">
                            <!-- filled by JS -->
                        </div>

                        <div class="verify-box">
                            <span class="verify-icon">📧</span>
                            <h3>Verify your email</h3>
                            <p>We'll send a 6-digit code to <strong id="emailDisplay"></strong>. Enter it below to
                                confirm your account.</p>
                            <div class="otp-wrap">
                                <input type="text" maxlength="1" class="otp-input" oninput="otpNext(this,0)" />
                                <input type="text" maxlength="1" class="otp-input" oninput="otpNext(this,1)" />
                                <input type="text" maxlength="1" class="otp-input" oninput="otpNext(this,2)" />
                                <input type="text" maxlength="1" class="otp-input" oninput="otpNext(this,3)" />
                                <input type="text" maxlength="1" class="otp-input" oninput="otpNext(this,4)" />
                                <input type="text" maxlength="1" class="otp-input" oninput="otpNext(this,5)" />
                            </div>
                            <p class="resend">Didn't get it? <a href="#" onclick="resendCode(event)">Resend
                                    code</a></p>
                        </div>

                        <button class="btn-back" onclick="goStep(3)">← Back</button>
                        <button class="btn-full" onclick="submitForm()" id="btnSubmit">
                            🎉 Create My Account
                        </button>
                    </div>

                </div><!-- /form-shell -->

                <!-- SUCCESS -->
                <div class="success-screen" id="successScreen">
                    <div class="success-icon">🎉</div>
                    <h2 id="successTitle">You're all set!</h2>
                    <p id="successMsg">Your account has been created. Welcome to StayHubRent!</p>
                    <div class="next-steps" id="nextSteps"></div>
                    <button class="btn-full" onclick="goDashboard()">Go to Dashboard →</button>
                </div>

            </div><!-- /form-card -->
        </div><!-- /form-panel -->
    </div><!-- /page -->

    <script>
        /* ── STATE ── */
        let currentStep = 1;
        let selectedRole = null;

        const roleInfo = {
            landlord: `🏡 <strong>As a Landlord</strong>, you'll be able to create properties, add rooms and beds, set monthly rent, approve tenant reservations, and track all payments in one dashboard.`,
            tenant: `🙋 <strong>As a Tenant</strong>, you can browse available rooms, filter by location/price/amenities, submit a reservation request, pay via GCash, and chat your landlord directly.`
        };

        /* ── THEME ── */
        const themeBtn = document.getElementById('themeBtn');
        themeBtn.addEventListener('click', () => {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            document.documentElement.setAttribute('data-theme', isDark ? 'light' : 'dark');
            themeBtn.textContent = isDark ? '🌙' : '☀️';

            // sync landing page if open (same tab navigation)
            try {
                localStorage.setItem('shr-theme', isDark ? 'light' : 'dark');
            } catch (e) {}
        });

        // Load theme from storage if coming from landing page
        try {
            const saved = localStorage.getItem('shr-theme');
            if (saved) {
                document.documentElement.setAttribute('data-theme', saved);
                themeBtn.textContent = saved === 'dark' ? '🌙' : '☀️';
            }
        } catch (e) {}

        /* ── ROLE SELECT ── */
        function selectRole(role) {
            selectedRole = role;
            document.querySelectorAll('.role-option').forEach(el => el.classList.remove('selected'));
            document.getElementById('role' + role.charAt(0).toUpperCase() + role.slice(1)).classList.add('selected');

            const info = document.getElementById('roleInfo');
            info.innerHTML = roleInfo[role];
            info.style.display = 'block';
            document.getElementById('btnStep1').disabled = false;

            // Update step 2 title
            document.getElementById('s2title').textContent = role === 'landlord' ? 'Landlord Account' : 'Tenant Account';
            document.getElementById('s2sub').textContent = role === 'landlord' ?
                'Set up your landlord login credentials' :
                'Set up your tenant login credentials';
        }

        /* ── STEP NAV ── */
        function goStep(n) {
            // hide current
            document.querySelectorAll('.step-slide').forEach(el => el.classList.remove('active'));

            currentStep = n;

            if (n === 3) {
                const slide = selectedRole === 'landlord' ? 'step3landlord' : 'step3tenant';
                document.getElementById(slide).classList.add('active');
            } else if (n === 4) {
                buildSummary();
                document.getElementById('step4').classList.add('active');
            } else {
                document.getElementById('step' + n).classList.add('active');
            }

            updateIndicator(n);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function updateIndicator(n) {
            const stepN = n === 3 || n === 4 ? n : n;
            for (let i = 1; i <= 4; i++) {
                const si = document.getElementById('si' + i);
                si.classList.remove('active', 'done');
                if (i < n) si.classList.add('done');
                else if (i === n) si.classList.add('active');

                if (i < 4) {
                    const sl = document.getElementById('sl' + i);
                    sl.classList.toggle('done', i < n);
                }
            }
        }

        /* ── PASSWORD ── */
        function togglePw(id, btn) {
            const inp = document.getElementById(id);
            inp.type = inp.type === 'password' ? 'text' : 'password';
            btn.textContent = inp.type === 'password' ? '👁' : '🙈';
        }

        function checkStrength() {
            const pw = document.getElementById('pwInput').value;
            const segs = [document.getElementById('seg1'), document.getElementById('seg2'), document.getElementById('seg3'),
                document.getElementById('seg4')
            ];
            const lbl = document.getElementById('strengthLabel');
            const colors = ['#ff6b6b', '#ffc850', '#6c9aff', '#5effd3'];
            const labels = ['Too short', 'Fair — add symbols', 'Good', 'Strong ✓'];

            let score = 0;
            if (pw.length >= 8) score++;
            if (/[A-Z]/.test(pw)) score++;
            if (/[0-9]/.test(pw)) score++;
            if (/[^A-Za-z0-9]/.test(pw)) score++;

            segs.forEach((s, i) => {
                s.style.background = i < score ? colors[score - 1] : 'var(--surface)';
            });
            lbl.textContent = pw.length ? labels[Math.max(0, score - 1)] : 'Enter a password';
            lbl.style.color = pw.length ? colors[score - 1] : 'var(--muted)';
        }

        /* ── AMENITY PILLS ── */
        function togglePill(el) {
            el.classList.toggle('on');
        }

        /* ── SUMMARY ── */
        function buildSummary() {
            const fname = document.getElementById('firstName').value || 'Not filled';
            const lname = document.getElementById('lastName').value || 'Not filled';
            const email = document.getElementById('emailInput').value || 'Not filled';
            const phone = document.getElementById('phoneInput').value || 'Not filled';

            document.getElementById('emailDisplay').textContent = email;

            const rows = [
                ['Full Name', `${fname} ${lname}`],
                ['Email', email],
                ['Phone', phone],
                ['Role', selectedRole === 'landlord' ? '🏡 Landlord' : '🙋 Tenant'],
                ['Status', `<span class="summary-badge">⏳ Pending Verification</span>`],
            ];
            if (selectedRole === 'landlord') {
                rows.push(['Admin Approval',
                    '<span class="summary-badge" style="background:rgba(255,126,179,.1);color:var(--accent3)">Required</span>'
                ]);
            }

            document.getElementById('summaryCard').innerHTML = rows.map(([k, v]) =>
                `<div class="summary-row"><span>${k}</span><strong>${v}</strong></div>`
            ).join('');
        }

        /* ── OTP ── */
        function otpNext(el, idx) {
            el.value = el.value.replace(/\D/g, '');
            const inputs = document.querySelectorAll('.otp-input');
            if (el.value && idx < 5) inputs[idx + 1].focus();
        }

        function resendCode(e) {
            e.preventDefault();
            const inputs = document.querySelectorAll('.otp-input');
            inputs.forEach(i => i.value = '');
            inputs[0].focus();
        }

        /* ── SUBMIT ── */
        function submitForm() {
            const btn = document.getElementById('btnSubmit');
            btn.textContent = '⏳ Creating account...';
            btn.disabled = true;

            setTimeout(() => {
                document.getElementById('formShell').style.display = 'none';
                const ss = document.getElementById('successScreen');
                ss.classList.add('show');

                if (selectedRole === 'landlord') {
                    document.getElementById('successTitle').textContent = '🏡 Landlord account created!';
                    document.getElementById('successMsg').textContent =
                        'Your account is pending admin verification. You\'ll be notified via email once approved — usually within 24 hours.';
                    document.getElementById('nextSteps').innerHTML = `
        <div class="ns-item"><div class="ns-num">1</div>Check your email for verification link</div>
        <div class="ns-item"><div class="ns-num">2</div>Wait for admin approval (≤24 hrs)</div>
        <div class="ns-item"><div class="ns-num">3</div>Add your first property & rooms</div>
        <div class="ns-item"><div class="ns-num">4</div>Start receiving tenant reservations</div>
      `;
                } else {
                    document.getElementById('successTitle').textContent = '🎉 Welcome to StayHubRent!';
                    document.getElementById('successMsg').textContent =
                        'Your tenant account is active. Start browsing rooms and find your perfect home today.';
                    document.getElementById('nextSteps').innerHTML = `
        <div class="ns-item"><div class="ns-num">1</div>Confirm your email address</div>
        <div class="ns-item"><div class="ns-num">2</div>Browse available rooms near you</div>
        <div class="ns-item"><div class="ns-num">3</div>Send a reservation request</div>
        <div class="ns-item"><div class="ns-num">4</div>Move in to your new home!</div>
      `;
                }
            }, 1800);
        }

        function goDashboard() {
            alert('Redirecting to dashboard... (Connect to your backend here)');
        }
    </script>
</body>

</html>
