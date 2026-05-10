<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>StayHubRent — Smart Rental Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap"
        rel="stylesheet" />
    <style>
        /* ── TOKENS ── */
        :root {
            --ease: cubic-bezier(.25, .8, .25, 1);
            --ease-spring: cubic-bezier(.34, 1.56, .64, 1);
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
            --accent2: #00c49a;
            --accent3: #e0487c;
            --glow: rgba(58, 111, 240, .12);
            --card-bg: #ffffff;
            --nav-bg: rgba(243, 245, 251, .88);
        }

        /* ── RESET ── */
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
            overflow-x: hidden;
            transition: background .4s var(--ease), color .4s var(--ease);
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
            padding: 1.1rem 4rem;
            background: var(--nav-bg);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
            transition: background .4s;
        }

        .nav-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .logo-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--accent);
            display: inline-block;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
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
            gap: 1rem;
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
            padding: .55rem 1.4rem;
            border-radius: 9px;
            border: none;
            background: var(--accent);
            color: #fff;
            cursor: pointer;
            box-shadow: 0 0 20px var(--glow);
            transition: .2s var(--ease);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 28px var(--glow);
        }

        /* Theme toggle */
        .theme-toggle {
            width: 42px;
            height: 24px;
            border-radius: 50px;
            background: var(--surface);
            border: 1px solid var(--border);
            cursor: pointer;
            position: relative;
            transition: .3s;
            display: flex;
            align-items: center;
            padding: 3px;
        }

        .theme-toggle::after {
            content: '';
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--accent);
            transition: .3s var(--ease-spring);
            transform: translateX(0);
        }

        [data-theme="light"] .theme-toggle::after {
            transform: translateX(18px);
        }

        .theme-icon {
            font-size: .85rem;
            position: absolute;
            right: 5px;
            top: 4px;
            pointer-events: none;
        }

        [data-theme="light"] .theme-icon {
            right: unset;
            left: 5px;
        }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 8rem 2rem 5rem;
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
            transition: opacity .5s;
        }

        .orb1 {
            width: 500px;
            height: 500px;
            background: var(--accent);
            top: -120px;
            left: -100px;
        }

        .orb2 {
            width: 400px;
            height: 400px;
            background: var(--accent3);
            bottom: -80px;
            right: -60px;
        }

        .orb3 {
            width: 300px;
            height: 300px;
            background: var(--accent2);
            top: 40%;
            left: 55%;
        }

        [data-theme="light"] .orb {
            opacity: .15;
        }

        /* grid pattern */
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
            margin-bottom: 2rem;
            animation: fadeUp .7s var(--ease) both;
        }

        .hero-badge span {
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
                transform: scale(1)
            }

            50% {
                opacity: .5;
                transform: scale(.8)
            }
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

        .hero h1 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2.8rem, 6vw, 5.2rem);
            font-weight: 800;
            line-height: 1.05;
            max-width: 820px;
            animation: fadeUp .7s .1s var(--ease) both;
            letter-spacing: -.02em;
        }

        .hero h1 em {
            font-style: normal;
            color: var(--accent);
        }

        .hero p {
            max-width: 560px;
            margin: 1.6rem auto 0;
            font-size: 1.12rem;
            line-height: 1.7;
            color: var(--muted);
            animation: fadeUp .7s .2s var(--ease) both;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeUp .7s .3s var(--ease) both;
        }

        .btn-lg {
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            padding: .85rem 2rem;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            background: var(--accent);
            color: #fff;
            box-shadow: 0 0 32px var(--glow);
            transition: .25s var(--ease);
        }

        .btn-lg:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 36px var(--glow);
        }

        .btn-outline-lg {
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            padding: .85rem 2rem;
            border-radius: 12px;
            cursor: pointer;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text);
            transition: .25s var(--ease);
        }

        .btn-outline-lg:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
            margin-top: 4rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeUp .7s .45s var(--ease) both;
        }

        .stat {
            text-align: center;
        }

        .stat strong {
            font-family: 'Syne', sans-serif;
            font-size: 1.9rem;
            font-weight: 800;
            display: block;
            color: var(--text);
        }

        .stat span {
            font-size: .85rem;
            color: var(--muted);
        }

        /* ── SECTION COMMON ── */
        section {
            padding: 6rem 2rem;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-label {
            font-size: .8rem;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: .8rem;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.9rem, 3.5vw, 2.8rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -.02em;
        }

        .section-desc {
            font-size: 1.05rem;
            color: var(--muted);
            line-height: 1.7;
            max-width: 540px;
            margin-top: .8rem;
        }

        /* ── ROLES ── */
        .roles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .role-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 2rem;
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
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.2rem;
        }

        .role-card h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: .6rem;
        }

        .role-card ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        .role-card ul li {
            font-size: .9rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .role-card ul li::before {
            content: '→';
            color: var(--accent);
            font-size: .8rem;
        }

        /* ── FEATURES ── */
        .features-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            margin-top: 2rem;
        }

        .feat-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            padding: 1.2rem;
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
            font-size: 1.1rem;
        }

        .feat-item h4 {
            font-family: 'Syne', sans-serif;
            font-size: .98rem;
            font-weight: 700;
            margin-bottom: .25rem;
        }

        .feat-item p {
            font-size: .88rem;
            color: var(--muted);
            line-height: 1.5;
        }

        /* Mock UI panel */
        .mock-panel {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 1.8rem;
            position: relative;
            overflow: hidden;
        }

        .mock-topbar {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: 1.5rem;
        }

        .mock-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .mock-title {
            font-family: 'Syne', sans-serif;
            font-size: .85rem;
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
            font-size: .75rem;
            color: var(--muted);
            margin-bottom: .3rem;
        }

        .mock-stat-card .val {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text);
        }

        .mock-stat-card .val span {
            font-size: .75rem;
            color: var(--accent2);
            font-family: 'DM Sans';
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
            padding: .75rem .9rem;
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
            font-size: .8rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .mock-info {
            flex: 1;
        }

        .mock-info strong {
            font-size: .85rem;
            display: block;
        }

        .mock-info small {
            font-size: .75rem;
            color: var(--muted);
        }

        .mock-badge {
            font-size: .7rem;
            font-weight: 600;
            padding: .25rem .65rem;
            border-radius: 50px;
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
            background: rgba(255, 126, 179, .12);
            color: var(--accent3);
        }

        /* ── HOW IT WORKS ── */
        .steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-top: 3rem;
            position: relative;
        }

        .steps::before {
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
            font-family: 'Syne', sans-serif;
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
            font-family: 'Syne', sans-serif;
            font-size: .98rem;
            font-weight: 700;
            margin-bottom: .4rem;
        }

        .step p {
            font-size: .87rem;
            color: var(--muted);
            line-height: 1.55;
        }

        /* ── PRICING ── */
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .price-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2rem;
            transition: .3s var(--ease);
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
            font-size: .72rem;
            font-weight: 700;
            padding: .3rem .75rem;
            border-radius: 50px;
            letter-spacing: .04em;
        }

        .price-card h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: .5rem;
        }

        .price-card .price {
            font-family: 'Syne', sans-serif;
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--text);
            margin: .8rem 0;
        }

        .price-card .price span {
            font-size: .9rem;
            font-weight: 400;
            color: var(--muted);
        }

        .price-card p {
            font-size: .88rem;
            color: var(--muted);
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .price-features {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .7rem;
            margin-bottom: 2rem;
        }

        .price-features li {
            font-size: .88rem;
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
            padding: 1.8rem;
            transition: .3s;
        }

        .testi-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
        }

        .stars {
            color: #ffc850;
            font-size: .9rem;
            margin-bottom: 1rem;
            letter-spacing: .1em;
        }

        .testi-card p {
            font-size: .92rem;
            color: var(--muted);
            line-height: 1.65;
            font-style: italic;
            margin-bottom: 1.4rem;
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
            font-size: .9rem;
        }

        .testi-author strong {
            font-size: .9rem;
            display: block;
        }

        .testi-author small {
            font-size: .78rem;
            color: var(--muted);
        }

        /* ── CTA SECTION ── */
        .cta-section {
            background: var(--card-bg);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            text-align: center;
            padding: 6rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .cta-section .orb {
            opacity: .2;
        }

        .cta-section h2 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 800;
            letter-spacing: -.02em;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .cta-section p {
            color: var(--muted);
            font-size: 1.05rem;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        /* ── FOOTER ── */
        footer {
            padding: 3rem 2rem;
            border-top: 1px solid var(--border);
        }

        .footer-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .footer-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
        }

        .footer-links a {
            font-size: .88rem;
            color: var(--muted);
            text-decoration: none;
            transition: .2s;
        }

        .footer-links a:hover {
            color: var(--text);
        }

        .footer-copy {
            font-size: .82rem;
            color: var(--muted);
        }

        /* ── RESPONSIVE ── */
        @media(max-width:900px) {
            nav {
                padding: 1rem 1.5rem;
            }

            .nav-links {
                display: none;
            }

            .roles-grid,
            .pricing-grid,
            .testi-grid {
                grid-template-columns: 1fr;
            }

            .steps {
                grid-template-columns: repeat(2, 1fr);
            }

            .features-wrap {
                grid-template-columns: 1fr;
            }

            .steps::before {
                display: none;
            }
        }

        /* scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity .65s var(--ease), transform .65s var(--ease);
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        /* ── FLOATING BADGE ── */
        .float-badge {
            position: absolute;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: .7rem 1rem;
            display: flex;
            align-items: center;
            gap: .6rem;
            font-size: .82rem;
            font-weight: 500;
            color: var(--text);
            box-shadow: 0 8px 30px rgba(0, 0, 0, .15);
            animation: floatY 4s ease-in-out infinite;
        }

        .float-badge .fi {
            font-size: 1.1rem;
        }

        @keyframes floatY {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-8px)
            }
        }

        .fb1 {
            top: 22%;
            right: 5%;
            animation-delay: 0s;
        }

        .fb2 {
            bottom: 28%;
            left: 4%;
            animation-delay: 1.5s;
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav>
        <div class="nav-logo"><span class="logo-dot"></span>StayHubRent</div>
        <ul class="nav-links">
            <li><a href="#roles">Roles</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#how">How It Works</a></li>
            <li><a href="#pricing">Pricing</a></li>
        </ul>
        <div class="nav-right">
            <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
                <span class="theme-icon" id="themeIcon">🌙</span>
            </button>
            <button class="btn-ghost">Log In</button>
            <button class="btn-primary">Get Started</button>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-bg">
            <div class="orb orb1"></div>
            <div class="orb orb2"></div>
            <div class="orb orb3"></div>
        </div>

        <div class="float-badge fb1"><span class="fi">🏠</span> 3 new properties listed</div>
        <div class="float-badge fb2"><span class="fi">✅</span> Reservation approved!</div>

        <div class="hero-badge"><span></span>The smarter way to manage rentals</div>

        <h1>Manage Your <em>Boarding House</em><br />Like a Pro</h1>
        <p>StayHubRent connects landlords and tenants on one elegant platform — from listing rooms to collecting rent,
            everything in one place.</p>

        <div class="hero-cta">
            <button class="btn-lg">Start for Free →</button>
            <button class="btn-outline-lg">See a Demo</button>
        </div>

        <div class="hero-stats">
            <div class="stat"><strong>3,000+</strong><span>Active Properties</span></div>
            <div class="stat"><strong>12k+</strong><span>Happy Tenants</span></div>
            <div class="stat"><strong>98%</strong><span>Satisfaction Rate</span></div>
        </div>
    </section>

    <!-- ROLES -->
    <section id="roles" style="background:var(--bg2);">
        <div class="container">
            <div class="reveal">
                <p class="section-label">User Roles</p>
                <h2 class="section-title">Built for everyone<br />in the rental journey</h2>
            </div>
            <div class="roles-grid reveal">

                <div class="role-card" style="--accent-card:#6c9aff">
                    <div class="role-icon">🛡️</div>
                    <h3>Super Admin</h3>
                    <p style="font-size:.88rem;color:var(--muted);margin-bottom:1rem;">Controls the entire platform with
                        full visibility.</p>
                    <ul>
                        <li>Verify landlords</li>
                        <li>Manage & suspend users</li>
                        <li>Analytics dashboard</li>
                        <li>Manage reports</li>
                    </ul>
                </div>

                <div class="role-card" style="--accent-card:#5effd3">
                    <div class="role-icon">🏡</div>
                    <h3>Landlord</h3>
                    <p style="font-size:.88rem;color:var(--muted);margin-bottom:1rem;">Full control over your property
                        and tenants.</p>
                    <ul>
                        <li>Create properties & rooms</li>
                        <li>Set rent & bed capacity</li>
                        <li>Approve reservations</li>
                        <li>Track payments</li>
                    </ul>
                </div>

                <div class="role-card" style="--accent-card:#ff7eb3">
                    <div class="role-icon">🙋</div>
                    <h3>Tenant</h3>
                    <p style="font-size:.88rem;color:var(--muted);margin-bottom:1rem;">Find and secure your perfect room
                        with ease.</p>
                    <ul>
                        <li>Browse properties</li>
                        <li>Reserve room or bed space</li>
                        <li>Pay & upload GCash receipt</li>
                        <li>Submit maintenance requests</li>
                    </ul>
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
                        <p class="section-label">Core Features</p>
                        <h2 class="section-title">Everything a<br />landlord needs</h2>
                        <p class="section-desc">From dynamic room setup to payment tracking — we've built every tool you
                            need to run a modern boarding house.</p>
                    </div>
                    <div class="features-list reveal">
                        <div class="feat-item active">
                            <div class="feat-icon">🏗️</div>
                            <div>
                                <h4>Dynamic Room & Bed Setup</h4>
                                <p>Choose floors, rooms, and beds — the system auto-generates the layout instantly.</p>
                            </div>
                        </div>
                        <div class="feat-item">
                            <div class="feat-icon">💳</div>
                            <div>
                                <h4>Payment Management</h4>
                                <p>Track monthly rent, due dates, GCash uploads, and auto-generate receipts.</p>
                            </div>
                        </div>
                        <div class="feat-item">
                            <div class="feat-icon">🔔</div>
                            <div>
                                <h4>Smart Notifications</h4>
                                <p>Payment reminders, reservation approvals, and maintenance updates in real time.</p>
                            </div>
                        </div>
                        <div class="feat-item">
                            <div class="feat-icon">🔧</div>
                            <div>
                                <h4>Maintenance Requests</h4>
                                <p>Tenants file issues; landlords update status from Pending → Ongoing → Fixed.</p>
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
                            <div class="label">Total Tenants</div>
                            <div class="val">24 <span>↑ 3 new</span></div>
                        </div>
                        <div class="mock-stat-card">
                            <div class="label">Available Rooms</div>
                            <div class="val">7 <span>of 18</span></div>
                        </div>
                        <div class="mock-stat-card">
                            <div class="label">Monthly Income</div>
                            <div class="val" style="color:var(--accent2)">₱84k</div>
                        </div>
                        <div class="mock-stat-card">
                            <div class="label">Pending Payments</div>
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
            <div class="reveal" style="text-align:center">
                <p class="section-label">How It Works</p>
                <h2 class="section-title">Up and running in minutes</h2>
            </div>
            <div class="steps reveal">
                <div class="step">
                    <div class="step-num">01</div>
                    <h4>Create Account</h4>
                    <p>Sign up as a landlord or tenant. Admins verify landlord accounts quickly.</p>
                </div>
                <div class="step">
                    <div class="step-num">02</div>
                    <h4>List Your Property</h4>
                    <p>Add boarding house details, set floors, rooms, and bed count. Upload photos.</p>
                </div>
                <div class="step">
                    <div class="step-num">03</div>
                    <h4>Tenants Reserve</h4>
                    <p>Tenants browse, search by price or amenity, and send a reservation request.</p>
                </div>
                <div class="step">
                    <div class="step-num">04</div>
                    <h4>Manage & Collect</h4>
                    <p>Approve reservations, track payments, handle maintenance — all in one dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PRICING -->
    <center>
        <section id="pricing">
            <div class="container">
                <div class="reveal" style="text-align:center">
                    <p class="section-label">Pricing</p>
                    <h2 class="section-title">Simple, transparent pricing</h2>
                    <p class="section-desc" style="margin:0 auto .5rem;">Start free. Scale as you grow.</p>
                </div>
                <div class="pricing-grid reveal">
                    <div class="price-card">
                        <h3>Starter</h3>
                        <div class="price">Free <span>/mo</span></div>
                        <p>Perfect for small landlords just getting started.</p>
                        <ul class="price-features">
                            <li>Up to 1 property</li>
                            <li>10 rooms maximum</li>
                            <li>Basic payment tracking</li>
                            <li>Tenant reservation</li>
                        </ul>
                        <button class="btn-outline-lg" style="width:100%">Get Started</button>
                    </div>
                    <div class="price-card popular">
                        <div class="popular-badge">POPULAR</div>
                        <h3>Pro Landlord</h3>
                        <div class="price">₱149 <span>/mo</span></div>
                        <p>For growing boarding houses with multiple properties.</p>
                        <ul class="price-features">
                            <li>Up to 5 properties</li>
                            <li>Unlimited rooms & beds</li>
                            <li>GCash integration</li>
                            <li>Maintenance requests</li>
                            <li>Notifications & reminders</li>
                        </ul>
                        <button class="btn-lg" style="width:100%">Start Pro →</button>
                    </div>

                </div>
            </div>
        </section>
    </center>

    <!-- TESTIMONIALS -->
    <section style="background:var(--bg2);">
        <div class="container">
            <div class="reveal" style="text-align:center">
                <p class="section-label">Testimonials</p>
                <h2 class="section-title">Loved by landlords & tenants</h2>
            </div>
            <div class="testi-grid reveal">
                <div class="testi-card">
                    <div class="stars">★★★★★</div>
                    <p>"I used to track payments on paper. StayHubRent changed everything — my tenants pay on time and I
                        get notified instantly."</p>
                    <div class="testi-author">
                        <div class="testi-avatar" style="background:#6c9aff">RD</div>
                        <div>
                            <strong>Rodrigo D.</strong>
                            <small>Landlord · Quezon City</small>
                        </div>
                    </div>
                </div>
                <div class="testi-card">
                    <div class="stars">★★★★★</div>
                    <p>"Found my dorm room in 10 minutes. The search filters made it super easy to find something with
                        wifi and aircon within budget."</p>
                    <div class="testi-author">
                        <div class="testi-avatar" style="background:#5effd3; color:#000">JL</div>
                        <div>
                            <strong>Julia L.</strong>
                            <small>Tenant · UST Student</small>
                        </div>
                    </div>
                </div>
                <div class="testi-card">
                    <div class="stars">★★★★★</div>
                    <p>"Managing 3 properties felt chaotic before. Now everything — rooms, tenants, income — is visible
                        in one clean dashboard."</p>
                    <div class="testi-author">
                        <div class="testi-avatar" style="background:#ff7eb3">MC</div>
                        <div>
                            <strong>Maria C.</strong>
                            <small>Landlord · Pasig City</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="orb orb1" style="top:-150px;left:-100px;opacity:.15"></div>
        <div class="orb orb2" style="bottom:-100px;right:-80px;opacity:.15"></div>
        <div class="reveal">
            <p class="section-label">Ready to Start?</p>
            <h2>Your smarter boarding<br />house starts here.</h2>
            <p>Join thousands of landlords managing their properties with ease.</p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <button class="btn-lg">Create Free Account →</button>
                <button class="btn-outline-lg">View All Features</button>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div class="footer-logo">StayHubRent</div>
            <div class="footer-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Support</a>
                <a href="#">Contact</a>
            </div>
            <p class="footer-copy">© 2025 StayHubRent. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Theme toggle
        const toggle = document.getElementById('themeToggle');
        const icon = document.getElementById('themeIcon');
        const html = document.documentElement;
        toggle.addEventListener('click', () => {
            const isDark = html.getAttribute('data-theme') === 'dark';
            html.setAttribute('data-theme', isDark ? 'light' : 'dark');
            icon.textContent = isDark ? '☀️' : '🌙';
        });

        // Scroll reveal
        const reveals = document.querySelectorAll('.reveal');
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.12
        });
        reveals.forEach(r => obs.observe(r));

        // Feature item active state
        document.querySelectorAll('.feat-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                document.querySelectorAll('.feat-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
            });
        });
    </script>
</body>

</html>
