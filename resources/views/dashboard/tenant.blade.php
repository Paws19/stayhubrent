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
    <link rel="stylesheet" href="{{ asset('css/tenant.css') }}" />
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
