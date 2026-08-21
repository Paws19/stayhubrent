<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tenant Dashboard — StayHubRent</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap"
        rel="stylesheet" />
    <style>
        /* ── TOKENS (matches marketing site) ── */
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
            --danger: #ff7e93;
            --warn: #ffc850;
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
            --danger: #e0487c;
            --warn: #b8860b;
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
            transition: background .4s var(--ease), color .4s var(--ease);
            min-height: 100vh;
        }

        a {
            color: inherit;
        }

        /* ── TOP NAV ── */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            padding: .85rem 1.5rem;
            background: var(--nav-bg);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
        }

        .menu-btn {
            display: none;
            width: 38px;
            height: 38px;
            border-radius: 9px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text);
            font-size: 1.1rem;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        .nav-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: .5rem;
            text-decoration: none;
        }

        .logo-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--accent);
            display: inline-block;
        }

        .topbar-spacer {
            flex: 1;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            position: relative;
            transition: .2s;
        }

        .icon-btn:hover {
            color: var(--text);
            border-color: var(--accent);
        }

        .icon-btn .dot {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent3);
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

        .user-chip {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .35rem .8rem .35rem .4rem;
            border-radius: 50px;
            border: 1px solid var(--border);
            background: var(--surface);
            cursor: pointer;
        }

        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .78rem;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
        }

        .user-chip span {
            font-size: .85rem;
            font-weight: 500;
        }

        /* ── LAYOUT ── */
        .shell {
            display: flex;
            min-height: calc(100vh - 65px);
        }

        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: var(--bg2);
            border-right: 1px solid var(--border);
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            gap: .3rem;
            transition: transform .3s var(--ease);
        }

        .side-label {
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 1rem .8rem .5rem;
        }

        .side-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .65rem .8rem;
            border-radius: 10px;
            font-size: .9rem;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            cursor: pointer;
            transition: .2s;
            border: 1px solid transparent;
        }

        .side-link .si {
            font-size: 1.05rem;
            width: 20px;
            text-align: center;
        }

        .side-link:hover {
            background: var(--surface);
            color: var(--text);
        }

        .side-link.active {
            background: var(--surface);
            color: var(--accent);
            border-color: var(--border);
        }

        .side-link.active .si {
            filter: none;
        }

        .main {
            flex: 1;
            padding: 2rem;
            max-width: 1180px;
        }

        .page-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.8rem;
        }

        .page-head h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.7rem;
            font-weight: 800;
            letter-spacing: -.01em;
        }

        .page-head p {
            color: var(--muted);
            font-size: .92rem;
            margin-top: .3rem;
        }

        .btn-primary {
            font-family: 'DM Sans', sans-serif;
            font-size: .88rem;
            font-weight: 600;
            padding: .65rem 1.3rem;
            border-radius: 10px;
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

        .btn-ghost {
            font-family: 'DM Sans', sans-serif;
            font-size: .85rem;
            font-weight: 500;
            padding: .55rem 1.1rem;
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

        /* ── STAT ROW ── */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.6rem;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.2rem 1.3rem;
            transition: transform .25s var(--ease), border-color .25s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: var(--accent);
        }

        .stat-card .label {
            font-size: .78rem;
            color: var(--muted);
            margin-bottom: .5rem;
        }

        .stat-card .val {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
        }

        .stat-card .val small {
            font-size: .72rem;
            font-weight: 500;
            color: var(--muted);
            font-family: 'DM Sans';
        }

        /* ── GRID / CARDS ── */
        .grid-2 {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 1.4rem;
            margin-bottom: 1.4rem;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 1.6rem;
        }

        .card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
        }

        .card-head h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.02rem;
            font-weight: 700;
        }

        .card-head a,
        .link-btn {
            font-size: .82rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            background: none;
            border: none;
            cursor: pointer;
        }

        /* My room card */
        .room-hero {
            display: flex;
            gap: 1.1rem;
            padding-bottom: 1.2rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 1.2rem;
        }

        .room-thumb {
            width: 92px;
            height: 92px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--accent), var(--accent3));
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .room-info h4 {
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: .3rem;
        }

        .room-info p {
            font-size: .85rem;
            color: var(--muted);
            margin-bottom: .15rem;
        }

        .badge {
            display: inline-block;
            font-size: .7rem;
            font-weight: 600;
            padding: .25rem .65rem;
            border-radius: 50px;
            margin-top: .5rem;
        }

        .badge-green {
            background: rgba(94, 255, 211, .12);
            color: var(--accent2);
        }

        .badge-yellow {
            background: rgba(255, 200, 80, .12);
            color: var(--warn);
        }

        .badge-red {
            background: rgba(255, 126, 179, .12);
            color: var(--danger);
        }

        .badge-blue {
            background: rgba(108, 154, 255, .12);
            color: var(--accent);
        }

        .detail-list {
            display: flex;
            flex-direction: column;
            gap: .7rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            font-size: .87rem;
        }

        .detail-row span:first-child {
            color: var(--muted);
        }

        .detail-row span:last-child {
            font-weight: 600;
        }

        /* Payment card */
        .due-box {
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.1rem 1.2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
        }

        .due-box .amt {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
        }

        .due-box .sub {
            font-size: .78rem;
            color: var(--muted);
            margin-top: .2rem;
        }

        .upload-drop {
            border: 1.5px dashed var(--border);
            border-radius: 14px;
            padding: 1.4rem;
            text-align: center;
            color: var(--muted);
            font-size: .85rem;
            cursor: pointer;
            transition: .2s;
        }

        .upload-drop:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--bg3);
        }

        .upload-drop .ic {
            font-size: 1.6rem;
            display: block;
            margin-bottom: .4rem;
        }

        /* Payment history table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            font-size: .74rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--muted);
            font-weight: 600;
            padding: .5rem .6rem;
            border-bottom: 1px solid var(--border);
        }

        tbody td {
            padding: .8rem .6rem;
            font-size: .87rem;
            border-bottom: 1px solid var(--border);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr {
            transition: background .2s;
        }

        tbody tr:hover {
            background: var(--bg3);
        }

        /* Maintenance list */
        .maint-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            padding: .9rem 0;
            border-bottom: 1px solid var(--border);
        }

        .maint-item:last-child {
            border-bottom: none;
        }

        .maint-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--bg3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .maint-info {
            flex: 1;
        }

        .maint-info h5 {
            font-size: .9rem;
            font-weight: 600;
            margin-bottom: .2rem;
        }

        .maint-info p {
            font-size: .8rem;
            color: var(--muted);
        }

        /* Notifications */
        .notif-item {
            display: flex;
            gap: .8rem;
            padding: .85rem 0;
            border-bottom: 1px solid var(--border);
        }

        .notif-item:last-child {
            border-bottom: none;
        }

        .notif-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            margin-top: .4rem;
            flex-shrink: 0;
        }

        .notif-item.read .notif-dot {
            background: var(--border);
        }

        .notif-info p {
            font-size: .86rem;
        }

        .notif-info small {
            font-size: .75rem;
            color: var(--muted);
        }

        /* Browse rooms */
        .browse-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .browse-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            transition: transform .25s var(--ease), border-color .25s;
            cursor: pointer;
        }

        .browse-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
        }

        .browse-thumb {
            height: 110px;
            background: linear-gradient(135deg, var(--bg3), var(--surface));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .browse-body {
            padding: 1rem 1.1rem 1.2rem;
        }

        .browse-body h5 {
            font-family: 'Syne', sans-serif;
            font-size: .95rem;
            font-weight: 700;
            margin-bottom: .3rem;
        }

        .browse-body .loc {
            font-size: .78rem;
            color: var(--muted);
            margin-bottom: .6rem;
        }

        .browse-body .price {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            color: var(--accent2);
            font-size: 1rem;
        }

        .browse-body .price span {
            font-size: .72rem;
            color: var(--muted);
            font-family: 'DM Sans';
            font-weight: 400;
        }

        /* ── RESPONSIVE ── */
        @media(max-width: 1000px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }

            .stat-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .browse-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 760px) {
            .menu-btn {
                display: flex;
            }

            .sidebar {
                position: fixed;
                top: 65px;
                left: 0;
                bottom: 0;
                z-index: 90;
                transform: translateX(-100%);
                box-shadow: 20px 0 40px rgba(0, 0, 0, .2);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main {
                padding: 1.3rem;
            }

            .stat-row {
                grid-template-columns: 1fr 1fr;
            }

            .browse-grid {
                grid-template-columns: 1fr;
            }

            .user-chip span {
                display: none;
            }
        }

        /* focus visibility */
        a:focus-visible,
        button:focus-visible,
        .side-link:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 300;
            background: rgba(6, 7, 12, .6);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity .25s var(--ease);
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-card {
            width: min(460px, 100%);
            max-height: 85vh;
            overflow-y: auto;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.7rem;
            box-shadow: 0 30px 70px rgba(0, 0, 0, .35);
            transform: translateY(18px) scale(.97);
            transition: transform .3s var(--ease-spring);
        }

        .modal-overlay.active .modal-card {
            transform: translateY(0) scale(1);
        }

        .modal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.3rem;
        }

        .modal-head h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -.01em;
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--muted);
            cursor: pointer;
            font-size: .9rem;
            flex-shrink: 0;
        }

        .modal-close:hover {
            color: var(--text);
            border-color: var(--accent);
        }

        .modal-body {
            font-size: .88rem;
            color: var(--text);
            line-height: 1.6;
        }

        .modal-body .detail-list {
            margin-top: .2rem;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: .7rem;
            margin-top: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-size: .8rem;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: .4rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            font-family: 'DM Sans', sans-serif;
            font-size: .87rem;
            color: var(--text);
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: .65rem .8rem;
            transition: .2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .success-box {
            text-align: center;
            padding: .5rem 0 .3rem;
        }

        .success-icon {
            font-size: 2.2rem;
            margin-bottom: .8rem;
        }

        .success-box p {
            margin-bottom: .5rem;
            color: var(--muted);
            font-size: .87rem;
        }

        .success-box p strong {
            color: var(--text);
            font-family: 'Syne', sans-serif;
        }

        /* ── ACCOUNT MENU ── */
        .account-menu {
            position: absolute;
            top: 60px;
            right: 1.5rem;
            width: 210px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: .5rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
            display: none;
            z-index: 150;
        }

        .account-menu.show {
            display: block;
        }

        .account-menu button {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            padding: .6rem .7rem;
            border-radius: 9px;
            font-family: 'DM Sans', sans-serif;
            font-size: .87rem;
            color: var(--text);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: .6rem;
        }

        .account-menu button:hover {
            background: var(--surface);
        }

        .account-menu button.danger {
            color: var(--danger);
        }

        .account-menu hr {
            border: none;
            border-top: 1px solid var(--border);
            margin: .35rem 0;
        }

        /* ── TOAST ── */
        .toast-wrap {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 400;
            display: flex;
            flex-direction: column;
            gap: .6rem;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: .6rem;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: .75rem 1.1rem;
            font-size: .85rem;
            color: var(--text);
            box-shadow: 0 12px 34px rgba(0, 0, 0, .22);
            animation: toastIn .3s var(--ease) both;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <!-- TOP BAR -->
    <div class="topbar">
        <button class="menu-btn" id="menuBtn" aria-label="Toggle menu">☰</button>
        <a href="#" class="nav-logo"><span class="logo-dot"></span>StayHubRent</a>
        <div class="topbar-spacer"></div>
        <button class="icon-btn" aria-label="Notifications"><span class="dot"></span>🔔</button>
        <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
            <span class="theme-icon" id="themeIcon">🌙</span>
        </button>
        <div class="user-chip">
            <div class="user-avatar">JL</div>
            <span>Julia Lopez</span>
        </div>
    </div>

    <div class="shell">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <p class="side-label">Overview</p>
            <a class="side-link active" data-target="dashboard"><span class="si">🏠</span>Dashboard</a>
            <a class="side-link" data-target="browse"><span class="si">🔍</span>Browse Rooms</a>
            <p class="side-label">My Stay</p>
            <a class="side-link" data-target="payments"><span class="si">💳</span>Payments</a>
            <a class="side-link" data-target="maintenance"><span class="si">🔧</span>Maintenance</a>
            <a class="side-link" data-target="notifications"><span class="si">🔔</span>Notifications</a>
            <p class="side-label">Account</p>
            <a class="side-link" data-target="profile"><span class="si">👤</span>Profile</a>
            <a class="side-link" data-target="logout"><span class="si">↩️</span>Log Out</a>
        </aside>

        <!-- MAIN -->
        <main class="main">
            <div class="page-head">
                <div>
                    <h1>Welcome back, Julia 👋</h1>
                    <p>Here's what's happening with your room and payments.</p>
                </div>
                <button class="btn-primary">+ New Maintenance Request</button>
            </div>

            <!-- STATS -->
            <div class="stat-row">
                <div class="stat-card">
                    <div class="label">Current Room</div>
                    <div class="val">B‑4</div>
                </div>
                <div class="stat-card">
                    <div class="label">Rent Due</div>
                    <div class="val" style="color:var(--accent3)">₱3,500 <small>May 15</small></div>
                </div>
                <div class="stat-card">
                    <div class="label">Lease Status</div>
                    <div class="val" style="color:var(--accent2)">Active</div>
                </div>
                <div class="stat-card">
                    <div class="label">Open Requests</div>
                    <div class="val">1 <small>ongoing</small></div>
                </div>
            </div>

            <div class="grid-2">
                <!-- MY ROOM -->
                <div class="card">
                    <div class="card-head">
                        <h3>My Room</h3>
                        <a href="#">View Lease</a>
                    </div>
                    <div class="room-hero">
                        <div class="room-thumb">🛏️</div>
                        <div class="room-info">
                            <h4>Sunview Boarding House · Room B‑4</h4>
                            <p>123 Marcos Alvarez Ave, Las Piñas</p>
                            <p>Landlord: Rodrigo D.</p>
                            <span class="badge badge-green">Lease Active</span>
                        </div>
                    </div>
                    <div class="detail-list">
                        <div class="detail-row"><span>Move-in date</span><span>Jan 10, 2026</span></div>
                        <div class="detail-row"><span>Monthly rent</span><span>₱3,500</span></div>
                        <div class="detail-row"><span>Bed capacity</span><span>2 of 2 occupied</span></div>
                        <div class="detail-row"><span>Amenities</span><span>Wifi, Aircon, CR</span></div>
                    </div>
                </div>

                <!-- PAYMENT -->
                <div class="card" id="payments">
                    <div class="card-head">
                        <h3>Payment</h3>
                        <a href="#">Full history</a>
                    </div>
                    <div class="due-box">
                        <div>
                            <div class="amt">₱3,500</div>
                            <div class="sub">Due May 15, 2026</div>
                        </div>
                        <span class="badge badge-yellow">Pending</span>
                    </div>
                    <div class="upload-drop">
                        <span class="ic">📤</span>
                        Upload GCash receipt to confirm payment
                    </div>
                </div>
            </div>

            <div class="grid-2">
                <!-- PAYMENT HISTORY -->
                <div class="card">
                    <div class="card-head">
                        <h3>Payment History</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Amount</th>
                                <th>Date Paid</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>April 2026</td>
                                <td>₱3,500</td>
                                <td>Apr 12</td>
                                <td><span class="badge badge-green">Paid</span></td>
                            </tr>
                            <tr>
                                <td>March 2026</td>
                                <td>₱3,500</td>
                                <td>Mar 14</td>
                                <td><span class="badge badge-green">Paid</span></td>
                            </tr>
                            <tr>
                                <td>February 2026</td>
                                <td>₱3,500</td>
                                <td>Feb 11</td>
                                <td><span class="badge badge-green">Paid</span></td>
                            </tr>
                            <tr>
                                <td>January 2026</td>
                                <td>₱3,500</td>
                                <td>—</td>
                                <td><span class="badge badge-red">Late</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- MAINTENANCE -->
                <div class="card" id="maintenance">
                    <div class="card-head">
                        <h3>Maintenance Requests</h3>
                        <button class="link-btn">+ New</button>
                    </div>
                    <div class="maint-item">
                        <div class="maint-icon">🚿</div>
                        <div class="maint-info">
                            <h5>Leaking faucet in shared CR</h5>
                            <p>Filed May 2 · Assigned to maintenance team</p>
                        </div>
                        <span class="badge badge-yellow">Ongoing</span>
                    </div>
                    <div class="maint-item">
                        <div class="maint-icon">💡</div>
                        <div class="maint-info">
                            <h5>Flickering hallway light</h5>
                            <p>Filed Apr 18 · Resolved by landlord</p>
                        </div>
                        <span class="badge badge-green">Fixed</span>
                    </div>
                    <div class="maint-item">
                        <div class="maint-icon">🔌</div>
                        <div class="maint-info">
                            <h5>Outlet not working, Room B‑4</h5>
                            <p>Filed Mar 30 · Resolved by landlord</p>
                        </div>
                        <span class="badge badge-green">Fixed</span>
                    </div>
                </div>
            </div>

            <div class="grid-2">
                <!-- NOTIFICATIONS -->
                <div class="card" id="notifications">
                    <div class="card-head">
                        <h3>Notifications</h3>
                        <a href="#">Mark all read</a>
                    </div>
                    <div class="notif-item">
                        <div class="notif-dot"></div>
                        <div class="notif-info">
                            <p>Rent reminder — ₱3,500 due May 15</p>
                            <small>2 hours ago</small>
                        </div>
                    </div>
                    <div class="notif-item">
                        <div class="notif-dot"></div>
                        <div class="notif-info">
                            <p>Maintenance update: faucet repair scheduled</p>
                            <small>Yesterday</small>
                        </div>
                    </div>
                    <div class="notif-item read">
                        <div class="notif-dot"></div>
                        <div class="notif-info">
                            <p>April payment confirmed — receipt approved</p>
                            <small>Apr 12</small>
                        </div>
                    </div>
                </div>

                <!-- BROWSE MORE -->
                <div class="card" id="browse">
                    <div class="card-head">
                        <h3>Browse Other Rooms</h3>
                        <a href="#">See all</a>
                    </div>
                    <div class="browse-grid">
                        <div class="browse-card">
                            <div class="browse-thumb">🏠</div>
                            <div class="browse-body">
                                <h5>Room A‑1</h5>
                                <div class="loc">Quezon City</div>
                                <div class="price">₱3,000 <span>/mo</span></div>
                            </div>
                        </div>
                        <div class="browse-card">
                            <div class="browse-thumb">🏠</div>
                            <div class="browse-body">
                                <h5>Bed Space, C‑2</h5>
                                <div class="loc">Pasig City</div>
                                <div class="price">₱2,200 <span>/mo</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

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

        // Mobile sidebar toggle
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        menuBtn.addEventListener('click', () => sidebar.classList.toggle('open'));

        // Sidebar active state + simple in-page scroll
        document.querySelectorAll('.side-link').forEach(link => {
            link.addEventListener('click', () => {
                document.querySelectorAll('.side-link').forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                const target = document.getElementById(link.dataset.target);
                if (target) target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                sidebar.classList.remove('open');
            });
        });

        /* ── DUMMY CLICK EXAMPLES ──
           Sample interactions only — replace with real logic / API calls later. */

        // New Maintenance Request button
        document.querySelector('.btn-primary').addEventListener('click', () => {
            alert('Dummy action: this would open a "New Maintenance Request" form.');
        });

        // "+ New" button inside Maintenance card
        document.querySelector('.link-btn').addEventListener('click', () => {
            alert('Dummy action: opens the maintenance request form.');
        });

        // GCash receipt upload dropzone
        document.querySelector('.upload-drop').addEventListener('click', () => {
            alert('Dummy action: this would open a file picker to upload your GCash receipt.');
        });

        // Notification bell
        document.querySelector('.icon-btn').addEventListener('click', () => {
            alert('Dummy action: shows a dropdown with your latest notifications.');
        });

        // User avatar chip
        document.querySelector('.user-chip').addEventListener('click', () => {
            alert('Dummy action: opens account menu (Profile, Settings, Log Out).');
        });

        // Generic "a" links inside card headers (View Lease, Full history, See all, Mark all read)
        document.querySelectorAll('.card-head a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                alert(`Dummy action: "${link.textContent.trim()}" clicked.`);
            });
        });

        // Payment history rows
        document.querySelectorAll('table tbody tr').forEach(row => {
            row.style.cursor = 'pointer';
            row.addEventListener('click', () => {
                const month = row.children[0].textContent;
                alert(`Dummy action: shows the receipt/details for ${month}.`);
            });
        });

        // Maintenance request items
        document.querySelectorAll('.maint-item').forEach(item => {
            item.style.cursor = 'pointer';
            item.addEventListener('click', () => {
                const title = item.querySelector('h5').textContent;
                alert(`Dummy action: opens full details for "${title}".`);
            });
        });

        // Notification items
        document.querySelectorAll('.notif-item').forEach(item => {
            item.style.cursor = 'pointer';
            item.addEventListener('click', () => {
                item.classList.add('read');
                alert('Dummy action: notification marked as read.');
            });
        });

        // Browse room cards (reserve action)
        document.querySelectorAll('.browse-card').forEach(card => {
            card.addEventListener('click', () => {
                const name = card.querySelector('h5').textContent;
                alert(`Dummy action: sends a reservation request for "${name}".`);
            });
        });
    </script>
</body>

</html>
