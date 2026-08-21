<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledger — Landlord Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Work+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --paper: #EAE6DA;
            --paper-raised: #F4F1E8;
            --ink: #22303F;
            --ink-soft: #4C5B6B;
            --navy: #1C2733;
            --navy-2: #243141;
            --brass: #B8863B;
            --brass-deep: #8F6A2C;
            --sage: #5B8266;
            --sage-bg: #E4EBE2;
            --rust: #B3503A;
            --rust-bg: #F3DFD8;
            --line: #D8D2C1;
            --shadow: 0 10px 30px rgba(28, 39, 51, 0.12);
            --radius: 14px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--paper);
            color: var(--ink);
            font-family: 'Work Sans', sans-serif;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        h3 {
            font-family: 'Fraunces', serif;
            margin: 0;
        }

        .mono {
            font-family: 'JetBrains Mono', monospace;
        }

        a {
            color: inherit;
        }

        /* ===== Layout ===== */
        .app {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 230px;
            flex-shrink: 0;
            background: var(--navy);
            color: #EDE9DD;
            display: flex;
            flex-direction: column;
            padding: 24px 18px;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
        }

        .brand-mark {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--brass);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Fraunces', serif;
            font-weight: 700;
            color: var(--navy);
            font-size: 18px;
            transform: rotate(-4deg);
        }

        .brand-name {
            font-family: 'Fraunces', serif;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        .brand-sub {
            font-size: 10.5px;
            color: #9BA9B8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: -2px;
        }

        .property-switch {
            background: var(--navy-2);
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 22px;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .property-switch label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #8FA0B0;
            margin-bottom: 4px;
        }

        .property-switch select {
            width: 100%;
            background: transparent;
            color: #EDE9DD;
            border: none;
            font-family: 'Work Sans', sans-serif;
            font-size: 13.5px;
            font-weight: 600;
            outline: none;
        }

        .property-switch select option {
            color: #111;
        }

        nav.navlinks {
            display: flex;
            flex-direction: column;
            gap: 3px;
            flex: 1;
        }

        .navlink {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 500;
            color: #C6D0DA;
            cursor: pointer;
            transition: background .15s, color .15s;
            border: none;
            background: transparent;
            text-align: left;
            width: 100%;
            font-family: inherit;
        }

        .navlink svg {
            flex-shrink: 0;
            opacity: 0.85;
        }

        .navlink:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
        }

        .navlink.active {
            background: var(--brass);
            color: var(--navy);
            font-weight: 700;
        }

        .navlink.active svg {
            opacity: 1;
        }

        .navlink .badge {
            margin-left: auto;
            background: var(--rust);
            color: #fff;
            font-size: 10.5px;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 20px;
        }

        .navlink.active .badge {
            background: var(--navy);
            color: #F4E8CE;
        }

        .sidebar-foot {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .owner-chip {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .owner-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--sage);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            color: #fff;
            flex-shrink: 0;
        }

        .owner-name {
            font-size: 13px;
            font-weight: 600;
        }

        .owner-role {
            font-size: 11px;
            color: #8FA0B0;
        }

        /* Main */
        .main {
            flex: 1;
            min-width: 0;
            padding: 30px 40px 60px;
        }

        .topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
            flex-wrap: wrap;
        }

        .topbar h1 {
            font-size: 26px;
            font-weight: 600;
        }

        .topbar .eyebrow {
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--brass-deep);
            font-weight: 700;
            margin-bottom: 4px;
        }

        .topbar-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn {
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 600;
            border-radius: 9px;
            padding: 9px 16px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: transform .12s, box-shadow .12s;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn:active {
            transform: scale(0.97);
        }

        .btn-primary {
            background: var(--navy);
            color: #F4E8CE;
        }

        .btn-primary:hover {
            box-shadow: 0 4px 14px rgba(28, 39, 51, 0.28);
        }

        .btn-ghost {
            background: var(--paper-raised);
            color: var(--ink);
            border-color: var(--line);
        }

        .btn-ghost:hover {
            border-color: var(--brass);
        }

        .btn-sm {
            padding: 6px 11px;
            font-size: 12.5px;
        }

        .month-select {
            background: var(--paper-raised);
            border: 1px solid var(--line);
            border-radius: 9px;
            padding: 8px 12px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
        }

        /* Stat cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--paper-raised);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 18px 20px;
            position: relative;
            overflow: hidden;
        }

        .stat-card .stat-label {
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--ink-soft);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .stat-card .stat-value {
            font-family: 'Fraunces', serif;
            font-size: 28px;
            font-weight: 600;
            color: var(--ink);
        }

        .stat-card .stat-delta {
            font-size: 12px;
            margin-top: 6px;
            font-weight: 600;
        }

        .stat-delta.up {
            color: var(--sage);
        }

        .stat-delta.down {
            color: var(--rust);
        }

        .stat-card .stat-icon {
            position: absolute;
            right: 14px;
            top: 14px;
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.9;
        }

        section.panel {
            background: var(--paper-raised);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 22px 24px;
            margin-bottom: 24px;
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .panel-head h2 {
            font-size: 18px;
            font-weight: 600;
        }

        .panel-head .sub {
            font-size: 12.5px;
            color: var(--ink-soft);
            margin-top: 2px;
        }

        .search-input {
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 9px;
            padding: 8px 12px;
            font-family: 'Work Sans', sans-serif;
            font-size: 13px;
            min-width: 200px;
            color: var(--ink);
        }

        .search-input:focus,
        .month-select:focus,
        select:focus {
            outline: 2px solid var(--brass);
            outline-offset: 1px;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--ink-soft);
            font-weight: 700;
            padding: 8px 10px;
            border-bottom: 2px solid var(--line);
        }

        td {
            padding: 12px 10px;
            border-bottom: 1px solid var(--line);
            font-size: 13.5px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr.tenant-row {
            cursor: pointer;
            transition: background .12s;
        }

        tr.tenant-row:hover {
            background: rgba(184, 134, 59, 0.07);
        }

        .unit-tag {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            font-weight: 600;
            background: var(--navy);
            color: #F4E8CE;
            padding: 3px 9px;
            border-radius: 6px;
            letter-spacing: 0.02em;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 11px;
            border-radius: 20px;
        }

        .status-pill.paid {
            background: var(--sage-bg);
            color: var(--sage);
        }

        .status-pill.due {
            background: #F1E7CE;
            color: var(--brass-deep);
        }

        .status-pill.overdue {
            background: var(--rust-bg);
            color: var(--rust);
        }

        .status-pill.vacant {
            background: #E4E4E4;
            color: #666;
        }

        .status-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .avatar-sm {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--brass);
            color: var(--navy);
            font-weight: 700;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 9px;
            flex-shrink: 0;
        }

        .name-cell {
            display: flex;
            align-items: center;
        }

        .name-cell .lease-note {
            font-size: 11.5px;
            color: var(--ink-soft);
        }

        /* Receipt stub - signature element */
        .ledger-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .receipt {
            display: flex;
            align-items: center;
            gap: 16px;
            background: var(--paper);
            border: 1px dashed var(--line);
            border-radius: 10px;
            padding: 13px 16px;
            position: relative;
            overflow: hidden;
        }

        .receipt .stamp {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%) rotate(-9deg);
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 11px;
            letter-spacing: 0.12em;
            border: 2px solid var(--sage);
            color: var(--sage);
            padding: 2px 9px;
            border-radius: 5px;
            opacity: 0.85;
        }

        .receipt.is-due .stamp {
            border-color: var(--brass-deep);
            color: var(--brass-deep);
        }

        .receipt.is-overdue .stamp {
            border-color: var(--rust);
            color: var(--rust);
        }

        .receipt-amt {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 15px;
            min-width: 96px;
        }

        .receipt-meta {
            flex: 1;
            min-width: 0;
        }

        .receipt-meta .who {
            font-weight: 600;
            font-size: 13.5px;
        }

        .receipt-meta .what {
            font-size: 12px;
            color: var(--ink-soft);
        }

        .receipt-action {
            margin-left: auto;
            padding-right: 78px;
        }

        /* Maintenance kanban */
        .kanban {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .kcol-head {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--ink-soft);
            margin-bottom: 10px;
        }

        .kcol-head .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .kcard {
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 12px 13px;
            margin-bottom: 10px;
            cursor: grab;
        }

        .kcard .ktitle {
            font-weight: 600;
            font-size: 13.5px;
            margin-bottom: 4px;
        }

        .kcard .kmeta {
            font-size: 11.5px;
            color: var(--ink-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .priority {
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 12px;
            text-transform: uppercase;
        }

        .priority.high {
            background: var(--rust-bg);
            color: var(--rust);
        }

        .priority.med {
            background: #F1E7CE;
            color: var(--brass-deep);
        }

        .priority.low {
            background: var(--sage-bg);
            color: var(--sage);
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(28, 39, 51, 0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 100;
            padding: 20px;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal {
            background: var(--paper-raised);
            border-radius: 16px;
            max-width: 420px;
            width: 100%;
            padding: 26px;
            box-shadow: var(--shadow);
            max-height: 88vh;
            overflow: auto;
        }

        .modal h3 {
            font-size: 19px;
            margin-bottom: 4px;
        }

        .modal .modal-sub {
            font-size: 12.5px;
            color: var(--ink-soft);
            margin-bottom: 18px;
        }

        .field {
            margin-bottom: 14px;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--ink-soft);
            margin-bottom: 5px;
        }

        .field input,
        .field select,
        .field textarea {
            width: 100%;
            padding: 9px 11px;
            border: 1px solid var(--line);
            border-radius: 8px;
            font-family: inherit;
            font-size: 13.5px;
            background: var(--paper);
            color: var(--ink);
        }

        .field textarea {
            resize: vertical;
            min-height: 60px;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .toast {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(120%);
            background: var(--navy);
            color: #F4E8CE;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            box-shadow: var(--shadow);
            transition: transform .25s ease;
            z-index: 200;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toast.show {
            transform: translateX(-50%) translateY(0);
        }

        .view {
            display: none;
        }

        .view.active {
            display: block;
        }

        .empty-state {
            text-align: center;
            padding: 36px 20px;
            color: var(--ink-soft);
        }

        .empty-state .em-title {
            font-family: 'Fraunces', serif;
            font-size: 16px;
            color: var(--ink);
            margin-bottom: 4px;
        }

        /* Mobile */
        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
        }

        @media(max-width:900px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .kanban {
                grid-template-columns: 1fr;
            }

            .main {
                padding: 20px 18px 50px;
            }
        }

        @media(max-width:680px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                transform: translateX(-104%);
                z-index: 90;
                transition: transform .25s ease;
                box-shadow: 12px 0 30px rgba(0, 0, 0, 0.2);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .hamburger {
                display: inline-flex;
            }

            .app {
                display: block;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .receipt {
                flex-wrap: wrap;
            }

            .receipt-action {
                padding-right: 0;
                margin-left: 0;
                width: 100%;
            }

            .receipt .stamp {
                position: static;
                transform: none;
                margin-top: 6px;
                display: inline-block;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr.tenant-row {
                border: 1px solid var(--line);
                border-radius: 10px;
                margin-bottom: 10px;
                padding: 6px 0;
            }

            td {
                border-bottom: none;
                padding: 6px 12px;
            }

            td[data-label]::before {
                content: attr(data-label);
                display: block;
                font-size: 10.5px;
                text-transform: uppercase;
                color: var(--ink-soft);
                font-weight: 700;
                letter-spacing: 0.05em;
                margin-bottom: 2px;
            }
        }

        .backdrop-sidebar {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 80;
            display: none;
        }

        .backdrop-sidebar.show {
            display: block;
        }
    </style>
</head>

<body>

    <div class="app">
        <div class="backdrop-sidebar" id="backdrop"></div>

        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <div class="brand-mark">L</div>
                <div>
                    <div class="brand-name">Ledger</div>
                    <div class="brand-sub">Landlord Console</div>
                </div>
            </div>

            <div class="property-switch">
                <label>Property</label>
                <select id="propertySelect">
                    <option>Casa Marbella Apartments</option>
                    <option>Sampaguita Duplex (2 units)</option>
                </select>
            </div>

            <nav class="navlinks">
                <button class="navlink active" data-view="overview">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <path d="M3 11L12 4l9 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M5 10v9a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1v-9" stroke="currentColor"
                            stroke-width="2" stroke-linejoin="round" />
                    </svg>
                    Overview
                </button>
                <button class="navlink" data-view="tenants">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <circle cx="9" cy="8" r="3.2" stroke="currentColor" stroke-width="2" />
                        <path d="M3.5 19c.5-3.5 3-5.5 5.5-5.5s5 2 5.5 5.5" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                        <circle cx="17" cy="9" r="2.4" stroke="currentColor" stroke-width="1.8" />
                        <path d="M15.5 19c.2-2.4 1.7-3.9 3.5-4" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                    Units &amp; Tenants
                </button>
                <button class="navlink" data-view="ledger">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <rect x="4" y="3" width="16" height="18" rx="2" stroke="currentColor"
                            stroke-width="2" />
                        <path d="M8 8h8M8 12h8M8 16h5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                    Rent Ledger
                    <span class="badge" id="overdueBadge">2</span>
                </button>
                <button class="navlink" data-view="maintenance">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <path d="M14.7 6.3a3 3 0 1 0-4.2 4.2L4 17v3h3l6.5-6.5a3 3 0 1 0 4.2-4.2l-2 2-2-1-1-2 2-2z"
                            stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                    </svg>
                    Maintenance
                    <span class="badge" id="maintBadge">3</span>
                </button>
                <button class="navlink" data-view="notices">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <path d="M4 5h16v11H9l-5 4V5z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                    </svg>
                    Notices
                </button>
            </nav>

            <div class="sidebar-foot">
                <div class="owner-chip">
                    <div class="owner-avatar">R</div>
                    <div>
                        <div class="owner-name">Raineil</div>
                        <div class="owner-role">Property Owner</div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="main">
            <div class="topbar">
                <div>
                    <div class="eyebrow" id="viewEyebrow">Casa Marbella Apartments</div>
                    <h1 id="viewTitle">Overview</h1>
                </div>
                <div class="topbar-actions" id="topbarActions"></div>
                <button class="hamburger" id="hamburgerBtn" aria-label="Open menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="#22303F" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <!-- OVERVIEW -->
            <div class="view active" id="view-overview">
                <div class="stats-grid" id="statsGrid"></div>

                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>This month's ledger</h2>
                            <div class="sub">Rent due on the 5th of every month</div>
                        </div>
                        <select class="month-select" id="monthSelect">
                            <option>August 2026</option>
                            <option>September 2026</option>
                        </select>
                    </div>
                    <div class="ledger-list" id="overviewLedger"></div>
                </section>

                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Open maintenance requests</h2>
                        </div>
                        <button class="btn btn-ghost btn-sm" data-goto="maintenance">View all</button>
                    </div>
                    <div id="overviewMaint"></div>
                </section>
            </div>

            <!-- TENANTS -->
            <div class="view" id="view-tenants">
                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Units &amp; Tenants</h2>
                            <div class="sub" id="occupancySub"></div>
                        </div>
                        <input class="search-input" id="tenantSearch" placeholder="Search unit or tenant name…">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Unit</th>
                                <th>Tenant</th>
                                <th>Rent</th>
                                <th>Lease ends</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tenantsBody"></tbody>
                    </table>
                </section>
            </div>

            <!-- LEDGER -->
            <div class="view" id="view-ledger">
                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Rent Ledger — August 2026</h2>
                            <div class="sub">Tap a receipt to mark it paid</div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="recordPaymentBtn">+ Record payment</button>
                    </div>
                    <div class="ledger-list" id="fullLedger"></div>
                </section>
            </div>

            <!-- MAINTENANCE -->
            <div class="view" id="view-maintenance">
                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Maintenance requests</h2>
                            <div class="sub">Drag between columns as work progresses</div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="newRequestBtn">+ New request</button>
                    </div>
                    <div class="kanban" id="kanbanBoard"></div>
                </section>
            </div>

            <!-- NOTICES -->
            <div class="view" id="view-notices">
                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Notices</h2>
                            <div class="sub">Reminders and lease notices you've sent tenants</div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="newNoticeBtn">+ Draft notice</button>
                    </div>
                    <div id="noticesList"></div>
                </section>
            </div>

        </main>
    </div>

    <!-- Payment modal -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal">
            <h3>Record a payment</h3>
            <div class="modal-sub">Log rent received from a tenant.</div>
            <div class="field">
                <label>Tenant / Unit</label>
                <select id="pmTenant"></select>
            </div>
            <div class="field">
                <label>Amount received (₱)</label>
                <input type="number" id="pmAmount" placeholder="e.g. 12000">
            </div>
            <div class="field">
                <label>Date received</label>
                <input type="date" id="pmDate">
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" data-close="paymentModal">Cancel</button>
                <button class="btn btn-primary" id="pmSave">Save payment</button>
            </div>
        </div>
    </div>

    <!-- Maintenance modal -->
    <div class="modal-overlay" id="maintModal">
        <div class="modal">
            <h3>New maintenance request</h3>
            <div class="modal-sub">Log an issue reported by a tenant, or one you've spotted.</div>
            <div class="field">
                <label>Unit</label>
                <select id="mmUnit"></select>
            </div>
            <div class="field">
                <label>What's the issue?</label>
                <textarea id="mmDesc" placeholder="e.g. Kitchen faucet leaking"></textarea>
            </div>
            <div class="field">
                <label>Priority</label>
                <select id="mmPriority">
                    <option value="low">Low</option>
                    <option value="med" selected>Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" data-close="maintModal">Cancel</button>
                <button class="btn btn-primary" id="mmSave">Add request</button>
            </div>
        </div>
    </div>

    <!-- Notice modal -->
    <div class="modal-overlay" id="noticeModal">
        <div class="modal">
            <h3>Draft a notice</h3>
            <div class="modal-sub">Send a reminder or lease notice to a tenant.</div>
            <div class="field">
                <label>Send to</label>
                <select id="ntTenant"></select>
            </div>
            <div class="field">
                <label>Subject</label>
                <input type="text" id="ntSubject" placeholder="e.g. Rent reminder — due Sept 5">
            </div>
            <div class="field">
                <label>Message</label>
                <textarea id="ntMessage" placeholder="Write your note to the tenant…"></textarea>
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" data-close="noticeModal">Cancel</button>
                <button class="btn btn-primary" id="ntSave">Save notice</button>
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        (function() {

            // ---------- Data ----------
            let units = [{
                    id: 'A1',
                    tenant: 'Marisol Dela Peña',
                    rent: 12000,
                    leaseEnds: '2027-01-31',
                    status: 'paid',
                    avatar: 'M'
                },
                {
                    id: 'A2',
                    tenant: 'Jun Torralba',
                    rent: 11000,
                    leaseEnds: '2026-12-15',
                    status: 'paid',
                    avatar: 'J'
                },
                {
                    id: 'A3',
                    tenant: 'Ella Ramoso',
                    rent: 12500,
                    leaseEnds: '2026-09-30',
                    status: 'due',
                    avatar: 'E'
                },
                {
                    id: 'B1',
                    tenant: 'Carlo Nieves',
                    rent: 10500,
                    leaseEnds: '2027-03-01',
                    status: 'overdue',
                    avatar: 'C'
                },
                {
                    id: 'B2',
                    tenant: 'Fatima Uy',
                    rent: 13000,
                    leaseEnds: '2026-11-20',
                    status: 'paid',
                    avatar: 'F'
                },
                {
                    id: 'B3',
                    tenant: null,
                    rent: 11500,
                    leaseEnds: null,
                    status: 'vacant',
                    avatar: ''
                },
                {
                    id: 'C1',
                    tenant: 'Renz Ababon',
                    rent: 12000,
                    leaseEnds: '2027-05-10',
                    status: 'overdue',
                    avatar: 'R'
                },
            ];

            let payments = [{
                    unit: 'A1',
                    tenant: 'Marisol Dela Peña',
                    amount: 12000,
                    date: '2026-08-03',
                    status: 'paid'
                },
                {
                    unit: 'A2',
                    tenant: 'Jun Torralba',
                    amount: 11000,
                    date: '2026-08-04',
                    status: 'paid'
                },
                {
                    unit: 'B2',
                    tenant: 'Fatima Uy',
                    amount: 13000,
                    date: '2026-08-02',
                    status: 'paid'
                },
                {
                    unit: 'A3',
                    tenant: 'Ella Ramoso',
                    amount: 12500,
                    date: null,
                    status: 'due'
                },
                {
                    unit: 'B1',
                    tenant: 'Carlo Nieves',
                    amount: 10500,
                    date: null,
                    status: 'overdue'
                },
                {
                    unit: 'C1',
                    tenant: 'Renz Ababon',
                    amount: 12000,
                    date: null,
                    status: 'overdue'
                },
            ];

            let maintenance = [{
                    id: 1,
                    unit: 'B1',
                    desc: 'Kitchen faucet leaking steadily',
                    priority: 'high',
                    col: 'new'
                },
                {
                    id: 2,
                    unit: 'A3',
                    desc: 'Aircon not cooling in bedroom',
                    priority: 'med',
                    col: 'new'
                },
                {
                    id: 3,
                    unit: 'C1',
                    desc: 'Front gate lock is stiff',
                    priority: 'low',
                    col: 'progress'
                },
                {
                    id: 4,
                    unit: 'A2',
                    desc: 'Replace hallway light bulb',
                    priority: 'low',
                    col: 'done'
                },
            ];

            let notices = [{
                    to: 'Carlo Nieves (B1)',
                    subject: 'Rent reminder — 5 days overdue',
                    date: 'Aug 10, 2026'
                },
                {
                    to: 'Renz Ababon (C1)',
                    subject: 'Rent reminder — 5 days overdue',
                    date: 'Aug 10, 2026'
                },
            ];

            const peso = n => '₱' + n.toLocaleString('en-PH');
            const toast = (msg) => {
                const t = document.getElementById('toast');
                t.innerHTML = msg;
                t.classList.add('show');
                clearTimeout(t._timer);
                t._timer = setTimeout(() => t.classList.remove('show'), 2600);
            };

            // ---------- Nav / views ----------
            const views = ['overview', 'tenants', 'ledger', 'maintenance', 'notices'];
            const titles = {
                overview: 'Overview',
                tenants: 'Units & Tenants',
                ledger: 'Rent Ledger',
                maintenance: 'Maintenance',
                notices: 'Notices'
            };

            function showView(name) {
                views.forEach(v => {
                    document.getElementById('view-' + v).classList.toggle('active', v === name);
                });
                document.querySelectorAll('.navlink').forEach(b => b.classList.toggle('active', b.dataset.view ===
                    name));
                document.getElementById('viewTitle').textContent = titles[name];
                closeSidebar();
            }

            document.querySelectorAll('.navlink').forEach(btn => {
                btn.addEventListener('click', () => showView(btn.dataset.view));
            });
            document.querySelectorAll('[data-goto]').forEach(btn => {
                btn.addEventListener('click', () => showView(btn.dataset.goto));
            });

            // Mobile sidebar
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('backdrop');
            document.getElementById('hamburgerBtn').addEventListener('click', () => {
                sidebar.classList.add('open');
                backdrop.classList.add('show');
            });

            function closeSidebar() {
                sidebar.classList.remove('open');
                backdrop.classList.remove('show');
            }
            backdrop.addEventListener('click', closeSidebar);

            // ---------- Stats ----------
            function renderStats() {
                const occupied = units.filter(u => u.status !== 'vacant').length;
                const vacant = units.filter(u => u.status === 'vacant').length;
                const collected = payments.filter(p => p.status === 'paid').reduce((s, p) => s + p.amount, 0);
                const outstanding = payments.filter(p => p.status !== 'paid').reduce((s, p) => s + p.amount, 0);
                const overdueCount = units.filter(u => u.status === 'overdue').length;

                const cards = [{
                        label: 'Occupied units',
                        value: `${occupied}/${units.length}`,
                        delta: `${vacant} vacant`,
                        cls: vacant ? 'down' : 'up'
                    },
                    {
                        label: 'Collected this month',
                        value: peso(collected),
                        delta: '3 payments in',
                        cls: 'up'
                    },
                    {
                        label: 'Outstanding',
                        value: peso(outstanding),
                        delta: `${overdueCount} overdue`,
                        cls: overdueCount ? 'down' : 'up'
                    },
                    {
                        label: 'Open maintenance',
                        value: String(maintenance.filter(m => m.col !== 'done').length),
                        delta: `${maintenance.filter(m=>m.priority==='high'&&m.col!=='done').length} high priority`,
                        cls: 'down'
                    },
                ];
                document.getElementById('statsGrid').innerHTML = cards.map(c => `
      <div class="stat-card">
        <div class="stat-label">${c.label}</div>
        <div class="stat-value">${c.value}</div>
        <div class="stat-delta ${c.cls}">${c.delta}</div>
      </div>`).join('');
            }

            // ---------- Ledger ----------
            function receiptHTML(p, compact) {
                const statusClass = p.status === 'paid' ? '' : (p.status === 'due' ? 'is-due' : 'is-overdue');
                const stampText = p.status === 'paid' ? 'PAID' : (p.status === 'due' ? 'DUE' : 'OVERDUE');
                return `
      <div class="receipt ${statusClass}" data-unit="${p.unit}">
        <div class="receipt-amt mono">${peso(p.amount)}</div>
        <div class="receipt-meta">
          <div class="who"><span class="unit-tag">${p.unit}</span> &nbsp;${p.tenant}</div>
          <div class="what">${p.status==='paid' ? 'Received '+formatDate(p.date) : 'Rent due Aug 5, 2026'}</div>
        </div>
        ${p.status!=='paid' ? `<div class="receipt-action"><button class="btn btn-ghost btn-sm mark-paid" data-unit="${p.unit}">Mark paid</button></div>` : ''}
        <div class="stamp">${stampText}</div>
      </div>`;
            }

            function formatDate(iso) {
                if (!iso) return '';
                const d = new Date(iso + 'T00:00:00');
                return d.toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                });
            }

            function renderLedger() {
                const sorted = [...payments].sort((a, b) => {
                    const order = {
                        overdue: 0,
                        due: 1,
                        paid: 2
                    };
                    return order[a.status] - order[b.status];
                });
                document.getElementById('fullLedger').innerHTML = sorted.map(p => receiptHTML(p)).join('');
                document.getElementById('overviewLedger').innerHTML = sorted.slice(0, 4).map(p => receiptHTML(p)).join(
                    '');
                document.getElementById('overdueBadge').textContent = payments.filter(p => p.status === 'overdue')
                    .length;
                attachMarkPaid();
            }

            function attachMarkPaid() {
                document.querySelectorAll('.mark-paid').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const unitId = btn.dataset.unit;
                        const p = payments.find(x => x.unit === unitId);
                        if (p) {
                            p.status = 'paid';
                            p.date = new Date().toISOString().slice(0, 10);
                        }
                        const u = units.find(x => x.id === unitId);
                        if (u) u.status = 'paid';
                        renderLedger();
                        renderStats();
                        renderTenants();
                        toast(`Marked ${unitId} as paid ✓`);
                    });
                });
            }

            // ---------- Tenants ----------
            function renderTenants(filter) {
                const q = (filter || '').toLowerCase();
                const rows = units.filter(u => {
                    if (!q) return true;
                    return u.id.toLowerCase().includes(q) || (u.tenant || '').toLowerCase().includes(q);
                });
                document.getElementById('tenantsBody').innerHTML = rows.map(u => {
                        if (u.status === 'vacant') {
                            return `<tr class="tenant-row">
          <td data-label="Unit"><span class="unit-tag">${u.id}</span></td>
          <td data-label="Tenant" colspan="1" style="color:var(--ink-soft);">— vacant —</td>
          <td data-label="Rent" class="mono">${peso(u.rent)}</td>
          <td data-label="Lease ends">—</td>
          <td data-label="Status"><span class="status-pill vacant">Vacant</span></td>
        </tr>`;
                        }
                        return `<tr class="tenant-row">
        <td data-label="Unit"><span class="unit-tag">${u.id}</span></td>
        <td data-label="Tenant">
          <div class="name-cell">
            <div class="avatar-sm">${u.avatar}</div>
            <div>${u.tenant}<div class="lease-note">Lease ends ${formatDate(u.leaseEnds)}</div></div>
          </div>
        </td>
        <td data-label="Rent" class="mono">${peso(u.rent)}</td>
        <td data-label="Lease ends">${formatDate(u.leaseEnds)}</td>
        <td data-label="Status"><span class="status-pill ${u.status}">${u.status.charAt(0).toUpperCase()+u.status.slice(1)}</span></td>
      </tr>`;
                    }).join('') ||
                    `<tr><td colspan="5"><div class="empty-state"><div class="em-title">No matches</div>Try a different unit or name.</div></td></tr>`;

                const occ = units.filter(u => u.status !== 'vacant').length;
                document.getElementById('occupancySub').textContent = `${occ} of ${units.length} units occupied`;
            }
            document.getElementById('tenantSearch').addEventListener('input', e => renderTenants(e.target.value));

            // ---------- Maintenance ----------
            const cols = [{
                    key: 'new',
                    label: 'New',
                    color: 'var(--rust)'
                },
                {
                    key: 'progress',
                    label: 'In progress',
                    color: 'var(--brass)'
                },
                {
                    key: 'done',
                    label: 'Done',
                    color: 'var(--sage)'
                },
            ];

            function renderKanban() {
                document.getElementById('kanbanBoard').innerHTML = cols.map(c => {
                    const items = maintenance.filter(m => m.col === c.key);
                    return `<div>
        <div class="kcol-head"><span class="dot" style="background:${c.color}"></span>${c.label} (${items.length})</div>
        ${items.map(m=>`
              <div class="kcard" draggable="true" data-id="${m.id}">
                <div class="ktitle">${m.desc}</div>
                <div class="kmeta">
                  <span class="unit-tag" style="font-size:10.5px;padding:2px 7px;">${m.unit}</span>
                  <span class="priority ${m.priority}">${m.priority}</span>
                </div>
              </div>`).join('') || `<div class="empty-state" style="padding:16px 8px;font-size:12.5px;">Nothing here</div>`}
      </div>`;
                }).join('');

                const overviewOpen = maintenance.filter(m => m.col !== 'done').slice(0, 3);
                document.getElementById('overviewMaint').innerHTML = overviewOpen.length ? overviewOpen.map(m => `
      <div class="receipt" style="border-style:solid;">
        <div class="receipt-meta">
          <div class="who"><span class="unit-tag">${m.unit}</span> &nbsp;${m.desc}</div>
          <div class="what">Status: ${cols.find(c=>c.key===m.col).label}</div>
        </div>
        <span class="priority ${m.priority}">${m.priority}</span>
      </div>`).join('') :
                    `<div class="empty-state"><div class="em-title">All caught up</div>No open maintenance requests.</div>`;

                document.getElementById('maintBadge').textContent = maintenance.filter(m => m.col !== 'done').length;
                attachDrag();
            }

            function attachDrag() {
                let dragId = null;
                document.querySelectorAll('.kcard').forEach(card => {
                    card.addEventListener('dragstart', () => {
                        dragId = card.dataset.id;
                    });
                });
                document.querySelectorAll('#kanbanBoard > div').forEach((colEl, idx) => {
                    colEl.addEventListener('dragover', e => e.preventDefault());
                    colEl.addEventListener('drop', () => {
                        const item = maintenance.find(m => String(m.id) === String(dragId));
                        if (item) {
                            item.col = cols[idx].key;
                            renderKanban();
                            renderStats();
                            toast('Request moved to ' + cols[idx].label);
                        }
                    });
                });
            }

            // ---------- Notices ----------
            function renderNotices() {
                document.getElementById('noticesList').innerHTML = notices.length ? notices.map(n => `
      <div class="receipt" style="border-style:solid;">
        <div class="receipt-meta">
          <div class="who">${n.subject}</div>
          <div class="what">To ${n.to} · ${n.date}</div>
        </div>
      </div>`).join('') :
                    `<div class="empty-state"><div class="em-title">No notices yet</div>Draft one when a reminder is due.</div>`;
            }

            // ---------- Modals ----------
            function openModal(id) {
                document.getElementById(id).classList.add('open');
            }

            function closeModal(id) {
                document.getElementById(id).classList.remove('open');
            }
            document.querySelectorAll('[data-close]').forEach(btn => {
                btn.addEventListener('click', () => closeModal(btn.dataset.close));
            });
            document.querySelectorAll('.modal-overlay').forEach(ov => {
                ov.addEventListener('click', e => {
                    if (e.target === ov) ov.classList.remove('open');
                });
            });

            function populateTenantSelects() {
                const occupiedUnits = units.filter(u => u.status !== 'vacant');
                const opts = occupiedUnits.map(u => `<option value="${u.id}">${u.id} — ${u.tenant}</option>`).join('');
                document.getElementById('pmTenant').innerHTML = opts;
                document.getElementById('ntTenant').innerHTML = opts;
                document.getElementById('mmUnit').innerHTML = units.map(u =>
                    `<option value="${u.id}">${u.id}${u.tenant? ' — '+u.tenant:' — vacant'}</option>`).join('');
            }

            document.getElementById('recordPaymentBtn').addEventListener('click', () => {
                populateTenantSelects();
                document.getElementById('pmDate').value = new Date().toISOString().slice(0, 10);
                openModal('paymentModal');
            });
            document.getElementById('pmSave').addEventListener('click', () => {
                const unitId = document.getElementById('pmTenant').value;
                const amount = Number(document.getElementById('pmAmount').value);
                const date = document.getElementById('pmDate').value;
                if (!unitId || !amount) {
                    toast('Add an amount to save this payment');
                    return;
                }
                const p = payments.find(x => x.unit === unitId);
                if (p) {
                    p.amount = amount;
                    p.status = 'paid';
                    p.date = date;
                }
                const u = units.find(x => x.id === unitId);
                if (u) u.status = 'paid';
                closeModal('paymentModal');
                document.getElementById('pmAmount').value = '';
                renderLedger();
                renderStats();
                renderTenants();
                toast(`Payment recorded for ${unitId} ✓`);
            });

            document.getElementById('newRequestBtn').addEventListener('click', () => {
                populateTenantSelects();
                openModal('maintModal');
            });
            document.getElementById('mmSave').addEventListener('click', () => {
                const unit = document.getElementById('mmUnit').value;
                const desc = document.getElementById('mmDesc').value.trim();
                const priority = document.getElementById('mmPriority').value;
                if (!desc) {
                    toast('Describe the issue first');
                    return;
                }
                maintenance.push({
                    id: Date.now(),
                    unit,
                    desc,
                    priority,
                    col: 'new'
                });
                document.getElementById('mmDesc').value = '';
                closeModal('maintModal');
                renderKanban();
                renderStats();
                toast('Maintenance request added ✓');
            });

            document.getElementById('newNoticeBtn').addEventListener('click', () => {
                populateTenantSelects();
                openModal('noticeModal');
            });
            document.getElementById('ntSave').addEventListener('click', () => {
                const unitId = document.getElementById('ntTenant').value;
                const subject = document.getElementById('ntSubject').value.trim();
                const u = units.find(x => x.id === unitId);
                if (!subject) {
                    toast('Add a subject line');
                    return;
                }
                notices.unshift({
                    to: `${u.tenant} (${u.id})`,
                    subject,
                    date: new Date().toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    })
                });
                document.getElementById('ntSubject').value = '';
                document.getElementById('ntMessage').value = '';
                closeModal('noticeModal');
                renderNotices();
                toast('Notice saved ✓');
            });

            // ---------- Init ----------
            renderStats();
            renderLedger();
            renderTenants();
            renderKanban();
            renderNotices();

        })();
    </script>
</body>

</html>
