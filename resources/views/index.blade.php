<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>StayHubRent — Smart Rental Management for Boarding Houses</title>
    <meta name="description"
        content="StayHubRent connects landlords and tenants — list a room, browse a place to stay, track rent, and handle repairs, all in one platform.">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap"
        rel="stylesheet" />
    <style>
        /* ── TOKENS ── */
        :root {
            --ease: cubic-bezier(.25, .8, .25, 1);
            --ease-spring: cubic-bezier(.34, 1.56, .64, 1);
            --maxw: 1100px;
        }

        [data-theme="dark"] {
            --bg: #0c0e14;
            --bg2: #13151e;
            --bg3: #1a1d28;
            --surface: #1f2232;
            --border: rgba(255, 255, 255, .07);
            --text: #e8eaf0;
            --muted: #8b90a8;
            --accent: #6c9aff;
            --accent2: #5effd3;
            --accent3: #ff7eb3;
            --glow: rgba(108, 154, 255, .18);
            --card-bg: #181b27;
            --nav-bg: rgba(12, 14, 20, .85);
            --danger-bg: rgba(255, 126, 179, .1);
        }

        [data-theme="light"] {
            --bg: #f3f5fb;
            --bg2: #eaecf5;
            --bg3: #dfe3f3;
            --surface: #ffffff;
            --border: rgba(0, 0, 0, .08);
            --text: #1a1d2e;
            --muted: #6b7094;
            --accent: #3a6ff0;
            --accent2: #00937a;
            --accent3: #d13d70;
            --glow: rgba(58, 111, 240, .12);
            --card-bg: #ffffff;
            --nav-bg: rgba(243, 245, 251, .88);
            --danger-bg: rgba(209, 61, 112, .08);
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

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            * {
                animation-duration: .001ms !important;
                transition-duration: .001ms !important;
            }
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            transition: background .4s var(--ease), color .4s var(--ease);
            font-size: 16px;
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Syne', sans-serif;
        }

        a {
            color: inherit;
        }

        img {
            max-width: 100%;
            display: block;
        }

        :focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
            border-radius: 4px;
        }

        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 3rem;
            background: var(--nav-bg);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
            transition: background .4s;
        }

        .nav-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: .55rem;
            text-decoration: none;
            flex-shrink: 0;
        }

        .logo-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--accent);
            display: inline-block;
            box-shadow: 0 0 10px var(--accent);
        }

        .nav-links {
            display: flex;
            gap: 2.2rem;
            list-style: none;
            margin: 0 auto;
        }

        .nav-links a {
            font-size: .92rem;
            font-weight: 400;
            color: var(--muted);
            text-decoration: none;
            transition: color .2s;
        }

        .nav-links a:hover {
            color: var(--text);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: .9rem;
            flex-shrink: 0;
        }

        .btn-ghost {
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 500;
            padding: .55rem 1.3rem;
            border-radius: 9px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text);
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: .2s;
        }

        .btn-ghost:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .btn-primary {
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            padding: .6rem 1.4rem;
            border-radius: 9px;
            border: none;
            background: var(--accent);
            color: #fff;
            cursor: pointer;
            box-shadow: 0 0 20px var(--glow);
            transition: .2s var(--ease);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 28px var(--glow);
        }

        .theme-toggle {
            width: 42px;
            height: 24px;
            border-radius: 50px;
            background: var(--surface);
            border: 1px solid var(--border);
            cursor: pointer;
            position: relative;
            transition: .3s;
            flex-shrink: 0;
        }

        .theme-toggle .knob {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .68rem;
            transition: transform .3s var(--ease-spring);
        }

        [data-theme="light"] .theme-toggle .knob {
            transform: translateX(18px);
        }

        .menu-btn {
            display: none;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            background: none;
            border: 1px solid var(--border);
            border-radius: 9px;
            width: 42px;
            height: 42px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .menu-btn span {
            display: block;
            width: 17px;
            height: 1.5px;
            background: var(--text);
            margin: 0 auto;
            transition: transform .25s var(--ease), opacity .2s var(--ease);
        }

        .menu-btn[aria-expanded="true"] span:nth-child(1) {
            transform: translateY(6.5px) rotate(45deg);
        }

        .menu-btn[aria-expanded="true"] span:nth-child(2) {
            opacity: 0;
        }

        .menu-btn[aria-expanded="true"] span:nth-child(3) {
            transform: translateY(-6.5px) rotate(-45deg);
        }

        /* Mobile nav panel */
        .mobile-panel {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--nav-bg);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 16px 34px rgba(0, 0, 0, .28);
            max-height: 0;
            overflow: hidden;
            transition: max-height .3s var(--ease);
        }

        .mobile-panel.open {
            max-height: 520px;
        }

        .mobile-panel-inner {
            padding: 1.3rem 1.5rem 1.9rem;
            display: flex;
            flex-direction: column;
            gap: .2rem;
        }

        .mobile-panel a.mob-link {
            padding: .85rem .2rem;
            font-size: 1rem;
            font-weight: 500;
            color: var(--text);
            border-bottom: 1px solid var(--border);
        }

        .mobile-panel a.mob-link:last-of-type {
            border-bottom: none;
        }

        .mobile-panel .mob-actions {
            display: flex;
            gap: .7rem;
            margin-top: 1.2rem;
        }

        .mobile-panel .mob-actions a {
            flex: 1;
            text-align: center;
        }

        /* ── HERO ── */
        .hero {
            min-height: 92vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 8rem 1.5rem 4rem;
            position: relative;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: .35;
        }

        [data-theme="light"] .orb {
            opacity: .15;
        }

        .orb1 {
            width: 480px;
            height: 480px;
            background: var(--accent);
            top: -120px;
            left: -100px;
        }

        .orb2 {
            width: 380px;
            height: 380px;
            background: var(--accent3);
            bottom: -80px;
            right: -60px;
        }

        .orb3 {
            width: 280px;
            height: 280px;
            background: var(--accent2);
            top: 42%;
            left: 56%;
        }

        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black, transparent);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .4rem 1rem;
            border-radius: 50px;
            background: var(--surface);
            border: 1px solid var(--border);
            font-size: .82rem;
            font-weight: 500;
            color: var(--muted);
            margin-bottom: 1.8rem;
            animation: fadeUp .7s var(--ease) both;
        }

        .hero-badge .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent2);
            display: inline-block;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .5;
                transform: scale(.8);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: clamp(2.4rem, 5.6vw, 4.6rem);
            font-weight: 800;
            line-height: 1.08;
            max-width: 820px;
            letter-spacing: -.02em;
            animation: fadeUp .7s .1s var(--ease) both;
        }

        .hero p.lede {
            max-width: 540px;
            margin: 1.5rem auto 0;
            font-size: 1.08rem;
            line-height: 1.7;
            color: var(--muted);
            animation: fadeUp .7s .2s var(--ease) both;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            margin-top: 2.3rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeUp .7s .3s var(--ease) both;
        }

        .btn-lg {
            font-family: 'DM Sans', sans-serif;
            font-size: .98rem;
            font-weight: 600;
            padding: .85rem 1.9rem;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            background: var(--accent);
            color: #fff;
            box-shadow: 0 0 32px var(--glow);
            transition: .25s var(--ease);
            text-decoration: none;
            display: inline-block;
        }

        .btn-lg:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 36px var(--glow);
        }

        .btn-outline-lg {
            font-family: 'DM Sans', sans-serif;
            font-size: .98rem;
            font-weight: 500;
            padding: .85rem 1.9rem;
            border-radius: 12px;
            cursor: pointer;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text);
            transition: .25s var(--ease);
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-lg:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .hero-note {
            margin-top: 1rem;
            font-size: .85rem;
            color: var(--muted);
            animation: fadeUp .7s .35s var(--ease) both;
        }

        .hero-trust {
            display: flex;
            gap: 2.2rem;
            margin-top: 3rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeUp .7s .42s var(--ease) both;
        }

        .hero-trust div {
            display: flex;
            align-items: center;
            gap: .55rem;
            font-size: .88rem;
            color: var(--muted);
            font-weight: 500;
        }

        .hero-trust svg {
            flex-shrink: 0;
            color: var(--accent2);
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
            margin-top: 3rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeUp .7s .5s var(--ease) both;
        }

        .stat {
            text-align: center;
        }

        .stat strong {
            font-size: 1.85rem;
            font-weight: 800;
            display: block;
            color: var(--text);
        }

        .stat span {
            font-size: .84rem;
            color: var(--muted);
        }

        .float-badge {
            position: absolute;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: .65rem .95rem;
            display: flex;
            align-items: center;
            gap: .55rem;
            font-size: .8rem;
            font-weight: 500;
            color: var(--text);
            box-shadow: 0 8px 30px rgba(0, 0, 0, .15);
            animation: floatY 4s ease-in-out infinite;
        }

        .float-badge svg {
            flex-shrink: 0;
            color: var(--accent);
        }

        @keyframes floatY {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .fb1 {
            top: 20%;
            right: 4%;
            animation-delay: 0s;
        }

        .fb2 {
            bottom: 24%;
            left: 3%;
            animation-delay: 1.5s;
        }

        @media (max-width: 760px) {
            .float-badge {
                display: none;
            }
        }

        /* ── SECTION COMMON ── */
        section {
            padding: 5.5rem 1.5rem;
        }

        .container {
            max-width: var(--maxw);
            margin: 0 auto;
        }

        .section-label {
            font-size: .8rem;
            font-weight: 600;
            color: var(--accent);
            margin-bottom: .7rem;
        }

        .section-title {
            font-size: clamp(1.8rem, 3.4vw, 2.6rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -.02em;
        }

        .section-desc {
            font-size: 1.02rem;
            color: var(--muted);
            line-height: 1.7;
            max-width: 560px;
            margin-top: .8rem;
        }

        .section-head-center {
            text-align: center;
        }

        .section-head-center .section-desc {
            margin-left: auto;
            margin-right: auto;
        }

        /* ── ROLES ── */
        .roles-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .role-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 2.1rem;
            transition: transform .3s var(--ease), box-shadow .3s, border-color .3s;
            position: relative;
            overflow: hidden;
        }

        .role-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--accent-card, var(--accent));
            opacity: 0;
            transition: .3s;
        }

        .role-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, .18);
        }

        .role-card:hover::before {
            opacity: 1;
        }

        .role-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-card, var(--accent));
            margin-bottom: 1.2rem;
        }

        .role-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: .5rem;
        }

        .role-card>p {
            font-size: .92rem;
            color: var(--muted);
            margin-bottom: 1.3rem;
        }

        .role-card ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .6rem;
            margin-bottom: 1.6rem;
        }

        .role-card ul li {
            font-size: .9rem;
            color: var(--text);
            display: flex;
            align-items: flex-start;
            gap: .6rem;
        }

        .role-card ul li::before {
            content: '→';
            color: var(--accent);
            font-size: .82rem;
            margin-top: .1rem;
            flex-shrink: 0;
        }

        .role-card .btn-outline-lg,
        .role-card .btn-lg {
            width: 100%;
            text-align: center;
        }

        /* ── FEATURES ── */
        .features-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3.5rem;
            align-items: center;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
            margin-top: 2rem;
        }

        .feat-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            padding: 1.1rem;
            border-radius: 14px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: .25s;
        }

        .feat-item:hover,
        .feat-item.active {
            background: var(--card-bg);
            border-color: var(--border);
        }

        .feat-icon {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 10px;
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
        }

        .feat-item h4 {
            font-size: .97rem;
            font-weight: 700;
            margin-bottom: .25rem;
        }

        .feat-item p {
            font-size: .88rem;
            color: var(--muted);
            line-height: 1.5;
        }

        .mock-panel {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 1.7rem;
            position: relative;
            overflow: hidden;
        }

        .mock-topbar {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: 1.4rem;
        }

        .mock-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .mock-title {
            font-size: .84rem;
            font-weight: 700;
            margin-left: auto;
            color: var(--muted);
        }

        .mock-stat-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: .8rem;
            margin-bottom: 1rem;
        }

        .mock-stat-card {
            background: var(--surface);
            border-radius: 12px;
            padding: 1rem;
            border: 1px solid var(--border);
        }

        .mock-stat-card .label {
            font-size: .74rem;
            color: var(--muted);
            margin-bottom: .3rem;
        }

        .mock-stat-card .val {
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--text);
        }

        .mock-stat-card .val span {
            font-size: .74rem;
            color: var(--accent2);
            font-family: 'DM Sans';
            font-weight: 400;
        }

        .mock-list {
            display: flex;
            flex-direction: column;
            gap: .6rem;
        }

        .mock-row {
            display: flex;
            align-items: center;
            gap: .8rem;
            padding: .72rem .9rem;
            background: var(--surface);
            border-radius: 10px;
            border: 1px solid var(--border);
        }

        .mock-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .78rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .mock-info {
            flex: 1;
        }

        .mock-info strong {
            font-size: .84rem;
            display: block;
        }

        .mock-info small {
            font-size: .74rem;
            color: var(--muted);
        }

        .mock-badge {
            font-size: .68rem;
            font-weight: 600;
            padding: .25rem .65rem;
            border-radius: 50px;
            flex-shrink: 0;
        }

        .badge-green {
            background: rgba(94, 255, 211, .12);
            color: var(--accent2);
        }

        .badge-yellow {
            background: rgba(255, 200, 80, .12);
            color: #ffc850;
        }

        .badge-red {
            background: var(--danger-bg);
            color: var(--accent3);
        }

        /* ── HOW IT WORKS ── */
        .steps-track {
            display: flex;
            gap: .6rem;
            justify-content: center;
            margin: 2.6rem 0 2.8rem;
        }

        .steps-tab {
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            background: var(--card-bg);
            border: 1px solid var(--border);
            padding: .6rem 1.3rem;
            border-radius: 50px;
            color: var(--muted);
            cursor: pointer;
            transition: .2s;
        }

        .steps-tab.active {
            color: #fff;
            background: var(--accent);
            border-color: var(--accent);
        }

        .steps-panel {
            display: none;
        }

        .steps-panel.active {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            position: relative;
        }

        .steps-panel.active::before {
            content: '';
            position: absolute;
            top: 28px;
            left: 10%;
            right: 10%;
            height: 1px;
            background: var(--border);
        }

        .step {
            text-align: center;
            position: relative;
        }

        .step-num {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--card-bg);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: 800;
            color: var(--accent);
            margin: 0 auto 1rem;
            position: relative;
            z-index: 1;
            transition: .3s;
        }

        .step:hover .step-num {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
            box-shadow: 0 0 20px var(--glow);
        }

        .step h4 {
            font-size: .96rem;
            font-weight: 700;
            margin-bottom: .4rem;
        }

        .step p {
            font-size: .86rem;
            color: var(--muted);
            line-height: 1.55;
        }

        /* ── PRICING ── */
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-top: 3rem;
            max-width: 760px;
            margin-left: auto;
            margin-right: auto;
        }

        .price-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .price-card.popular {
            border-color: var(--accent);
            box-shadow: 0 0 40px var(--glow);
        }

        .popular-badge {
            position: absolute;
            top: 1.2rem;
            right: 1.2rem;
            background: var(--accent);
            color: #fff;
            font-size: .7rem;
            font-weight: 700;
            padding: .3rem .75rem;
            border-radius: 50px;
        }

        .price-card h3 {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: .5rem;
        }

        .price-card .price {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text);
            margin: .7rem 0;
        }

        .price-card .price span {
            font-size: .88rem;
            font-weight: 400;
            color: var(--muted);
        }

        .price-card>p {
            font-size: .87rem;
            color: var(--muted);
            margin-bottom: 1.4rem;
            line-height: 1.5;
        }

        .price-features {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .65rem;
            margin-bottom: 1.8rem;
        }

        .price-features li {
            font-size: .87rem;
            color: var(--muted);
            display: flex;
            gap: .6rem;
        }

        .price-features li::before {
            content: '✓';
            color: var(--accent2);
            font-weight: 700;
        }

        /* ── TESTIMONIALS ── */
        .testi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .testi-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 1.7rem;
            transition: .3s;
        }

        .testi-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
        }

        .stars {
            color: #ffc850;
            font-size: .88rem;
            margin-bottom: 1rem;
            letter-spacing: .1em;
        }

        .testi-card p {
            font-size: .9rem;
            color: var(--muted);
            line-height: 1.65;
            margin-bottom: 1.3rem;
        }

        .testi-author {
            display: flex;
            align-items: center;
            gap: .8rem;
        }

        .testi-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #fff;
            font-size: .88rem;
            flex-shrink: 0;
        }

        .testi-author strong {
            font-size: .89rem;
            display: block;
        }

        .testi-author small {
            font-size: .77rem;
            color: var(--muted);
        }

        /* ── FAQ ── */
        .faq-list {
            max-width: 740px;
            margin: 2.6rem auto 0;
            display: flex;
            flex-direction: column;
            gap: .7rem;
        }

        details.faq-item {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.1rem 1.4rem;
        }

        details.faq-item summary {
            cursor: pointer;
            font-weight: 600;
            font-size: .96rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            list-style: none;
            gap: 1rem;
        }

        details.faq-item summary::-webkit-details-marker {
            display: none;
        }

        details.faq-item summary::after {
            content: '+';
            font-size: 1.3rem;
            color: var(--accent);
            font-weight: 400;
            flex-shrink: 0;
        }

        details.faq-item[open] summary::after {
            content: '\2013';
        }

        details.faq-item p {
            margin-top: .8rem;
            font-size: .9rem;
            color: var(--muted);
            line-height: 1.6;
        }

        /* ── HELP STRIP ── */
        .help-strip {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.2rem 1.5rem;
            margin-top: 2.6rem;
            max-width: 740px;
            margin-left: auto;
            margin-right: auto;
            font-size: .92rem;
            color: var(--muted);
        }

        .help-strip strong {
            color: var(--text);
        }

        .help-strip .fi {
            color: var(--accent);
            flex-shrink: 0;
        }

        /* ── CTA ── */
        .cta-section {
            background: var(--card-bg);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            text-align: center;
            padding: 5.5rem 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .cta-section .orb {
            opacity: .15;
        }

        .cta-section h2 {
            font-size: clamp(1.9rem, 3.8vw, 3rem);
            font-weight: 800;
            letter-spacing: -.02em;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .cta-section p {
            color: var(--muted);
            font-size: 1.02rem;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        /* ── FOOTER ── */
        footer {
            padding: 3.5rem 1.5rem 2rem;
            border-top: 1px solid var(--border);
        }

        .footer-grid {
            max-width: var(--maxw);
            margin: 0 auto 2.4rem;
            display: grid;
            grid-template-columns: 1.3fr 1fr 1fr 1fr;
            gap: 2rem;
        }

        .footer-brand .nav-logo {
            margin-bottom: .8rem;
        }

        .footer-grid>div>p {
            font-size: .88rem;
            color: var(--muted);
            max-width: 32ch;
        }

        .footer-grid h5 {
            font-size: .82rem;
            font-weight: 700;
            margin-bottom: .9rem;
            color: var(--text);
        }

        .footer-grid ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .55rem;
        }

        .footer-grid a {
            font-size: .88rem;
            color: var(--muted);
            text-decoration: none;
            transition: .2s;
        }

        .footer-grid a:hover {
            color: var(--accent);
        }

        .footer-bottom {
            max-width: var(--maxw);
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            padding-top: 1.6rem;
            border-top: 1px solid var(--border);
            font-size: .84rem;
            color: var(--muted);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 920px) {
            nav {
                padding: 1rem 1.5rem;
            }

            .nav-links {
                display: none;
            }

            .nav-desktop-item {
                display: none;
            }

            .menu-btn {
                display: flex;
            }

            .mobile-panel {
                display: block;
            }

            .roles-grid,
            .pricing-grid,
            .testi-grid,
            .features-wrap {
                grid-template-columns: 1fr;
            }

            .steps-panel.active {
                grid-template-columns: 1fr 1fr;
            }

            .steps-panel.active::before {
                display: none;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 560px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .steps-panel.active {
                grid-template-columns: 1fr;
            }

            .hero-trust {
                flex-direction: column;
                gap: .8rem;
                align-items: center;
            }
        }

        /* scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .6s var(--ease), transform .6s var(--ease);
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav>
        <a href="/" class="nav-logo"><span class="logo-dot"></span>StayHubRent</a>
        <ul class="nav-links">
            <li><a href="#roles">Roles</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#how">How it works</a></li>
            <li><a href="#faq">FAQ</a></li>
        </ul>
        <div class="nav-right">
            <button class="theme-toggle" id="themeToggle" aria-label="Switch between light and dark mode">
                <span class="knob" id="themeKnob"></span>
            </button>
            <a href="{{ route('login') }}" class="btn-ghost nav-desktop-item">Log in</a>
            <a href="{{ route('get-started') }}" class="btn-primary nav-desktop-item">Get started</a>
            <button class="menu-btn" id="menuBtn" aria-label="Open menu" aria-expanded="false"
                aria-controls="mobilePanel">
                <span></span><span></span><span></span>
            </button>
        </div>

        <div class="mobile-panel" id="mobilePanel">
            <div class="mobile-panel-inner">
                <a href="#roles" class="mob-link">Roles</a>
                <a href="#features" class="mob-link">Features</a>
                <a href="#how" class="mob-link">How it works</a>
                <a href="#faq" class="mob-link">FAQ</a>
                <div class="mob-actions">
                    <a href="{{ route('login') }}" class="btn-ghost">Log in</a>
                    <a href="{{ route('get-started') }}" class="btn-primary">Get started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-bg">
            <div class="orb orb1"></div>
            <div class="orb orb2"></div>
            <div class="orb orb3"></div>
        </div>

        <div class="float-badge fb1">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            12 new listings this week
        </div>
        <div class="float-badge fb2">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M20 6L9 17l-5-5" />
            </svg>
            Reservation approved
        </div>

        <div class="hero-badge"><span class="dot"></span>The smarter way to manage rentals</div>

        <h1>Manage your boarding house like a pro</h1>
        <p class="lede">List rooms, approve tenants, collect rent through GCash, and track repairs — all in one place.
        </p>

        <div class="hero-cta">
            <a href="{{ route('get-started', ['role' => 'tenant']) }}" class="btn-lg">I'm looking for a room</a>
            <a href="{{ route('get-started', ['role' => 'landlord']) }}" class="btn-outline-lg">I have a property to
                list</a>
        </div>
        <p class="hero-note">Free to sign up. No listing fees to get started.</p>

        <div class="hero-trust">
            <div><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                </svg>Verified property owners</div>
            <div><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <rect x="2" y="5" width="20" height="14" rx="2" />
                    <path d="M2 10h20" />
                </svg>Pay rent through GCash</div>
            <div><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path
                        d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.77z" />
                </svg>Repairs tracked, start to finish</div>
        </div>

        <div class="hero-stats">
            <div class="stat"><strong>3,000+</strong><span>Active properties</span></div>
            <div class="stat"><strong>12k+</strong><span>Happy tenants</span></div>
            <div class="stat"><strong>98%</strong><span>Satisfaction rate</span></div>
        </div>
    </section>

    <!-- ROLES -->
    <section id="roles" style="background:var(--bg2);">
        <div class="container">
            <div class="reveal">
                <p class="section-label">Made for the two people who matter most</p>
                <h2 class="section-title">Built for everyone in the rental journey</h2>
                <p class="section-desc">Everything you need to rent or manage a room — nothing you don't.</p>
            </div>

            <div class="roles-grid reveal">
                <div class="role-card" style="--accent-card:#ff7eb3">
                    <div class="role-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <rect x="3" y="7" width="18" height="13" rx="2" />
                            <path d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2" />
                        </svg>
                    </div>
                    <h3>If you're renting</h3>
                    <p>Find a room close to school, work, or family — at a price you can afford.</p>
                    <ul>
                        <li>Browse real rooms with photos, price, and a map</li>
                        <li>Send a reservation request straight to the owner</li>
                        <li>Pay rent by GCash and keep a record of every receipt</li>
                        <li>Report a leaky faucet or broken light in a few taps</li>
                    </ul>
                    <a href="{{ route('get-started', ['role' => 'tenant']) }}" class="btn-outline-lg">Find a room</a>
                </div>

                <div class="role-card" id="owners" style="--accent-card:#5effd3">
                    <div class="role-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            <path d="M9 22V12h6v10" />
                        </svg>
                    </div>
                    <h3>If you own a property</h3>
                    <p>List rooms, choose tenants, and see who's paid at a glance.</p>
                    <ul>
                        <li>List rooms with photos, rent, and beds available</li>
                        <li>Approve or decline reservation requests yourself</li>
                        <li>See who has paid, who's due, and who's overdue</li>
                        <li>Keep repair requests organized in one list</li>
                    </ul>
                    <a href="{{ route('get-started', ['role' => 'landlord']) }}" class="btn-lg">List your property</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section id="features">
        <div class="container">
            <div class="features-wrap">
                <div>
                    <div class="reveal">
                        <p class="section-label">Core features</p>
                        <h2 class="section-title">Everything both sides need</h2>
                        <p class="section-desc">Just the day-to-day tools for renting and managing a room.</p>
                    </div>
                    <div class="features-list reveal">
                        <div class="feat-item active">
                            <div class="feat-icon"><svg width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="3" y="3" width="7" height="7" />
                                    <rect x="14" y="3" width="7" height="7" />
                                    <rect x="3" y="14" width="7" height="7" />
                                    <rect x="14" y="14" width="7" height="7" />
                                </svg></div>
                            <div>
                                <h4>Instant room & bed setup</h4>
                                <p>Set your floors and rooms — the layout builds itself.</p>
                            </div>
                        </div>
                        <div class="feat-item">
                            <div class="feat-icon"><svg width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="2" y="5" width="20" height="14" rx="2" />
                                    <path d="M2 10h20" />
                                </svg></div>
                            <div>
                                <h4>Simple rent tracking</h4>
                                <p>Tenants pay by GCash and upload the receipt. You mark it received.</p>
                            </div>
                        </div>
                        <div class="feat-item">
                            <div class="feat-icon"><svg width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9" />
                                    <path d="M13.7 21a2 2 0 01-3.4 0" />
                                </svg></div>
                            <div>
                                <h4>Helpful reminders</h4>
                                <p>Tenants get a nudge before rent is due. You get notified when it's paid.</p>
                            </div>
                        </div>
                        <div class="feat-item">
                            <div class="feat-icon"><svg width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path
                                        d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.77z" />
                                </svg></div>
                            <div>
                                <h4>Repairs that don't get lost</h4>
                                <p>Tenants report an issue with a photo. You track it to done.</p>
                            </div>
                        </div>
                        <div class="feat-item">
                            <div class="feat-icon"><svg width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z" />
                                </svg></div>
                            <div>
                                <h4>Direct messages</h4>
                                <p>Message your tenant or landlord without swapping phone numbers.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MOCK DASHBOARD -->
                <div class="mock-panel reveal">
                    <div class="mock-topbar">
                        <div class="mock-dot" style="background:#ff5f57"></div>
                        <div class="mock-dot" style="background:#ffbd2e"></div>
                        <div class="mock-dot" style="background:#28c840"></div>
                        <span class="mock-title">Landlord Dashboard</span>
                    </div>
                    <div class="mock-stat-row">
                        <div class="mock-stat-card">
                            <div class="label">Total tenants</div>
                            <div class="val">24 <span>↑ 3 new</span></div>
                        </div>
                        <div class="mock-stat-card">
                            <div class="label">Available rooms</div>
                            <div class="val">7 <span>of 18</span></div>
                        </div>
                        <div class="mock-stat-card">
                            <div class="label">Monthly income</div>
                            <div class="val" style="color:var(--accent2)">₱84k</div>
                        </div>
                        <div class="mock-stat-card">
                            <div class="label">Pending payments</div>
                            <div class="val" style="color:var(--accent3)">4</div>
                        </div>
                    </div>
                    <div class="mock-list">
                        <div class="mock-row">
                            <div class="mock-avatar" style="background:#6c9aff">KR</div>
                            <div class="mock-info">
                                <strong>Kristine Reyes</strong>
                                <small>Room B-4 · Due May 15</small>
                            </div>
                            <div class="mock-badge badge-green">Paid</div>
                        </div>
                        <div class="mock-row">
                            <div class="mock-avatar" style="background:#ffc850">MJ</div>
                            <div class="mock-info">
                                <strong>Marco Jimenez</strong>
                                <small>Room A-2 · Due May 10</small>
                            </div>
                            <div class="mock-badge badge-yellow">Pending</div>
                        </div>
                        <div class="mock-row">
                            <div class="mock-avatar" style="background:#ff7eb3">AL</div>
                            <div class="mock-info">
                                <strong>Ana Lopez</strong>
                                <small>Room C-1 · Overdue</small>
                            </div>
                            <div class="mock-badge badge-red">Overdue</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="how" style="background:var(--bg2);">
        <div class="container">
            <div class="reveal section-head-center">
                <p class="section-label">How it works</p>
                <h2 class="section-title">Up and running in minutes</h2>
            </div>

            <div class="steps-track reveal" role="tablist" aria-label="Choose a walkthrough">
                <button class="steps-tab active" role="tab" aria-selected="true" data-panel="renter-steps">For
                    renters</button>
                <button class="steps-tab" role="tab" aria-selected="false" data-panel="owner-steps">For property
                    owners</button>
            </div>

            <div class="steps-panel active reveal" id="renter-steps">
                <div class="step">
                    <div class="step-num">1</div>
                    <h4>Create your account</h4>
                    <p>Sign up with your name and mobile number. Takes about two minutes.</p>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <h4>Search for a room</h4>
                    <p>Filter by price, location, or amenities like WiFi and aircon.</p>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <h4>Send a request</h4>
                    <p>Tell the owner your move-in date. They'll respond with a yes or no.</p>
                </div>
                <div class="step">
                    <div class="step-num">4</div>
                    <h4>Move in and settle</h4>
                    <p>Pay your rent and report repairs, right from your dashboard.</p>
                </div>
            </div>

            <div class="steps-panel" id="owner-steps">
                <div class="step">
                    <div class="step-num">1</div>
                    <h4>Create your account</h4>
                    <p>Sign up as a property owner. We verify your details before you list.</p>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <h4>Add your property</h4>
                    <p>Enter your floors, rooms, and beds — set the rent for each one.</p>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <h4>Review requests</h4>
                    <p>Approve renters you're comfortable with, right from your phone.</p>
                </div>
                <div class="step">
                    <div class="step-num">4</div>
                    <h4>Collect and manage</h4>
                    <p>Track payments, send reminders, and handle repairs in one dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section style="background:var(--bg2);">
        <div class="container">
            <div class="reveal section-head-center">
                <p class="section-label">Testimonials</p>
                <h2 class="section-title">Loved by landlords & tenants</h2>
            </div>
            <div class="testi-grid reveal">
                <div class="testi-card">
                    <div class="stars">★★★★★</div>
                    <p>I used to track payments on paper. StayHubRent changed everything — my tenants pay on time and I
                        get notified instantly.</p>
                    <div class="testi-author">
                        <div class="testi-avatar" style="background:#6c9aff">RD</div>
                        <div><strong>Rodrigo D.</strong><small>Landlord · Quezon City</small></div>
                    </div>
                </div>
                <div class="testi-card">
                    <div class="stars">★★★★★</div>
                    <p>Found my dorm room in 10 minutes. The search filters made it easy to find something with WiFi and
                        aircon within budget.</p>
                    <div class="testi-author">
                        <div class="testi-avatar" style="background:#5effd3; color:#000">JL</div>
                        <div><strong>Julia L.</strong><small>Tenant · UST student</small></div>
                    </div>
                </div>
                <div class="testi-card">
                    <div class="stars">★★★★★</div>
                    <p>Managing 3 properties felt chaotic before. Now everything — rooms, tenants, income — is visible
                        in one clean dashboard.</p>
                    <div class="testi-author">
                        <div class="testi-avatar" style="background:#ff7eb3">MC</div>
                        <div><strong>Maria C.</strong><small>Landlord · Pasig City</small></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq">
        <div class="container">
            <div class="reveal section-head-center">
                <p class="section-label">Common questions</p>
                <h2 class="section-title">Before you sign up</h2>
            </div>

            <div class="faq-list reveal">
                <details class="faq-item">
                    <summary>Is it free to use?</summary>
                    <p>Yes. Browsing rooms is free for renters. Owners can list one property free, with a Pro plan for
                        managing more.</p>
                </details>
                <details class="faq-item">
                    <summary>How do I pay my rent?</summary>
                    <p>Send it through GCash, then upload your receipt. Your landlord confirms it and it's recorded for
                        both of you.</p>
                </details>
                <details class="faq-item">
                    <summary>Is my personal information safe?</summary>
                    <p>We only ask for what's needed to connect you — your name, number, and basic account details.
                        Never sold or shown publicly.</p>
                </details>
                <details class="faq-item">
                    <summary>What if something breaks in my room?</summary>
                    <p>Open Maintenance, describe the issue, add a photo. Your landlord is notified right away.</p>
                </details>
                <details class="faq-item">
                    <summary>I own a property. How do I get verified?</summary>
                    <p>Fill in your property details after signup. Our team reviews new owners before listings go live.
                    </p>
                </details>
            </div>

            <div class="help-strip reveal">
                <span class="fi"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M9.09 9a3 3 0 015.83 1c0 2-3 2-3 4" />
                        <path d="M12 17h.01" />
                    </svg></span>
                <span><strong>New to renting apps?</strong> No problem — it's built to feel like a normal website. If
                    you get stuck, support is one message away.</span>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="orb orb1" style="top:-150px; left:-100px;"></div>
        <div class="orb orb2" style="bottom:-100px; right:-80px;"></div>
        <div class="reveal">
            <p class="section-label">Ready to start?</p>
            <h2>Your smarter boarding house starts here</h2>
            <p>Joining takes less than two minutes.</p>
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; position:relative; z-index:1;">
                <a href="{{ route('get-started') }}" class="btn-lg">Create your free account</a>
                <a href="{{ route('login') }}" class="btn-outline-lg">Log in</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="/" class="nav-logo"><span class="logo-dot"></span>StayHubRent</a>
                <p>Connecting renters and property owners across the Philippines, one room at a time.</p>
            </div>
            <div>
                <h5>For Renters</h5>
                <ul>
                    <li><a href="#roles">Browse rooms</a></li>
                    <li><a href="{{ route('get-started', ['role' => 'tenant']) }}">Create an account</a></li>
                    <li><a href="#faq">How payments work</a></li>
                </ul>
            </div>
            <div>
                <h5>For Owners</h5>
                <ul>
                    <li><a href="#owners">List a property</a></li>
                    <li><a href="{{ route('get-started', ['role' => 'landlord']) }}">Create an account</a></li>
                    <li><a href="#faq">Getting verified</a></li>
                </ul>
            </div>
            <div>
                <h5>Support</h5>
                <ul>
                    <li><a href="#faq">Help center</a></li>
                    <li><a href="mailto:support@stayhubrent.com">Contact us</a></li>
                    <li><a href="#">Privacy policy</a></li>
                    <li><a href="#">Terms of service</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© 2026 StayHubRent. All rights reserved.</span>
            <span>Made for boarding houses, dorms, and apartments across the Philippines.</span>
        </div>
    </footer>

    <script>
        // ---- Theme toggle (persists across visits) ----
        const html = document.documentElement;
        const themeToggle = document.getElementById('themeToggle');
        const themeKnob = document.getElementById('themeKnob');

        function applyTheme(theme) {
            html.setAttribute('data-theme', theme);
            themeKnob.textContent = theme === 'dark' ? '🌙' : '☀️';
            try {
                localStorage.setItem('stayhub-theme', theme);
            } catch (e) {}
        }

        (function initTheme() {
            let saved = null;
            try {
                saved = localStorage.getItem('stayhub-theme');
            } catch (e) {}
            if (saved) {
                applyTheme(saved);
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
                applyTheme('light');
            }
        })();

        themeToggle.addEventListener('click', () => {
            const isDark = html.getAttribute('data-theme') === 'dark';
            applyTheme(isDark ? 'light' : 'dark');
        });

        // ---- Mobile menu ----
        const menuBtn = document.getElementById('menuBtn');
        const mobilePanel = document.getElementById('mobilePanel');

        function closeMenu() {
            mobilePanel.classList.remove('open');
            menuBtn.setAttribute('aria-expanded', 'false');
        }

        menuBtn.addEventListener('click', () => {
            const isOpen = mobilePanel.classList.toggle('open');
            menuBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        mobilePanel.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMenu);
        });

        document.addEventListener('click', (e) => {
            if (!mobilePanel.contains(e.target) && !menuBtn.contains(e.target)) {
                closeMenu();
            }
        });

        // ---- How It Works tabs ----
        document.querySelectorAll('.steps-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.steps-tab').forEach(t => {
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });
                document.querySelectorAll('.steps-panel').forEach(p => p.classList.remove('active'));
                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');
                document.getElementById(tab.dataset.panel).classList.add('active');
            });
        });

        // ---- Scroll reveal ----
        const reveals = document.querySelectorAll('.reveal');
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, {
            threshold: 0.12
        });
        reveals.forEach(r => obs.observe(r));

        // ---- Feature item active state ----
        document.querySelectorAll('.feat-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                document.querySelectorAll('.feat-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
            });
        });
    </script>
</body>

</html>
