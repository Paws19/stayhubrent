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
    <!-- Leaflet + OpenStreetMap — free, no API key required -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>

    <!-- TOP BAR -->
    <div class="topbar">
        <button class="menu-btn" id="menuBtn" aria-label="Toggle menu">☰</button>
        <a href="#" class="nav-logo"><span class="logo-dot"></span>StayHubRent</a>
        <div class="topbar-spacer"></div>
        <button class="icon-btn" id="bellBtn" aria-label="Notifications"><span class="dot"></span>🔔</button>
        <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
            <span class="theme-icon" id="themeIcon">🌙</span>
        </button>
        <button class="user-chip" id="userChip">
            <div class="user-avatar">JL</div>
            <span>Julia Lopez</span>
        </button>
    </div>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="shell">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <p class="side-label">Overview</p>
            <button class="side-link active" data-page="dashboard"><span class="si">🏠</span>Dashboard</button>
            <button class="side-link" data-page="browse"><span class="si">🔍</span>Browse Rooms</button>
            <p class="side-label">My Stay</p>
            <button class="side-link" data-page="payments"><span class="si">💳</span>Payments</button>
            <button class="side-link" data-page="maintenance"><span class="si">🔧</span>Maintenance
                <span class="badge-count">1</span></button>
            <button class="side-link" data-page="notifications"><span class="si">🔔</span>Notifications
                <span class="badge-count">2</span></button>
            <p class="side-label">Account</p>
            <button class="side-link" data-page="profile"><span class="si">👤</span>Profile</button>
            <!-- LOGOUT — opens the confirm modal at the bottom of the page -->
            <button type="button" class="side-link" data-open-modal="logoutModal">
                <span class="si">↩️</span>
                <span>Log Out</span>
            </button>
        </aside>

        <!-- MAIN -->
        <main class="main">

            <!-- PAGE: DASHBOARD -->
            <section class="page active" id="page-dashboard">
                <div class="page-head">
                    <div>
                        <h1 id="greeting">Welcome back, Julia 👋</h1>
                        <p>Here's what's happening with your room and payments.</p>
                    </div>
                    <button class="btn-primary" data-open-modal="requestModal">+ New Maintenance Request</button>
                </div>

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
                    <div>
                        <!-- MY ROOM -->
                        <div class="card">
                            <div class="card-head">
                                <h3>My Room</h3>
                                <a href="#" data-toast="Dummy action: opens your lease PDF.">View Lease</a>
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

                            <!-- ROOM LOCATION MAP (Leaflet + OpenStreetMap — no API key needed) -->
                            <div class="room-map" id="roomMap" data-lat="14.4445" data-lng="120.9938"></div>
                            <a href="https://www.openstreetmap.org/?mlat=14.4445&mlon=120.9938#map=17/14.4445/120.9938"
                                target="_blank" rel="noopener" class="map-link">Get directions ↗</a>
                        </div>

                        <!-- RECENT ACTIVITY -->
                        <div class="card">
                            <div class="card-head">
                                <h3>Recent Activity</h3>
                                <button class="link-btn" data-page-link="notifications">See all</button>
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
                        </div>
                    </div>

                    <div>
                        <!-- GETTING STARTED -->
                        <div class="card">
                            <div class="card-head">
                                <h3>Getting Started</h3>
                            </div>
                            <div class="checklist" id="checklist">
                                <div class="check-item done"><span class="tick">✓</span><span class="txt">Verify
                                        email address</span></div>
                                <div class="check-item done"><span class="tick">✓</span><span class="txt">Sign
                                        lease agreement</span></div>
                                <div class="check-item" data-page-link="profile"><span class="tick"></span><span
                                        class="txt">Add a profile photo</span></div>
                                <div class="check-item" data-page-link="payments"><span class="tick"></span><span
                                        class="txt">Set up your first payment</span></div>
                            </div>
                        </div>

                        <!-- QUICK PAYMENT -->
                        <div class="card">
                            <div class="card-head">
                                <h3>Payment</h3>
                                <button class="link-btn" data-page-link="payments">Full history</button>
                            </div>
                            <div class="due-box">
                                <div>
                                    <div class="amt">₱3,500</div>
                                    <div class="sub">Due May 15, 2026</div>
                                </div>
                                <span class="badge badge-yellow">Pending</span>
                            </div>
                            <button class="btn-ghost" style="width:100%" data-page-link="payments">Upload receipt
                                →</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- PAGE: BROWSE ROOMS -->
            <section class="page" id="page-browse">
                <div class="page-head">
                    <div>
                        <h1>Browse Rooms</h1>
                        <p>Looking to move or refer a friend? See what's open right now.</p>
                    </div>
                </div>

                <div class="search-row">
                    <input type="text" placeholder="Search by location or property name…" id="browseSearch" />
                    <button class="filter-chip active">All</button>
                    <button class="filter-chip">Under ₱3,000</button>
                    <button class="filter-chip">Near me</button>
                </div>

                <div class="browse-grid" id="browseGrid">
                    <div class="browse-card" data-room-id="a1">
                        <div class="browse-thumb">🏠</div>
                        <div class="browse-body">
                            <h5>Room A‑1</h5>
                            <div class="loc">Quezon City</div>
                            <div class="price">₱3,000 <span>/mo</span></div>
                        </div>
                    </div>
                    <div class="browse-card" data-room-id="c2">
                        <div class="browse-thumb">🏠</div>
                        <div class="browse-body">
                            <h5>Bed Space, C‑2</h5>
                            <div class="loc">Pasig City</div>
                            <div class="price">₱2,200 <span>/mo</span></div>
                        </div>
                    </div>
                    <div class="browse-card" data-room-id="d3">
                        <div class="browse-thumb">🏠</div>
                        <div class="browse-body">
                            <h5>Room D‑3</h5>
                            <div class="loc">Las Piñas</div>
                            <div class="price">₱3,800 <span>/mo</span></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- PAGE: PAYMENTS -->
            <section class="page" id="page-payments">
                <div class="page-head">
                    <div>
                        <h1>Payments</h1>
                        <p>Track what's due and confirm your GCash payments.</p>
                    </div>
                </div>

                <div class="grid-2">
                    <div>
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
                                <tbody id="paymentHistoryBody">
                                    <tr data-month="April 2026">
                                        <td>April 2026</td>
                                        <td>₱3,500</td>
                                        <td>Apr 12</td>
                                        <td><span class="badge badge-green">Paid</span></td>
                                    </tr>
                                    <tr data-month="March 2026">
                                        <td>March 2026</td>
                                        <td>₱3,500</td>
                                        <td>Mar 14</td>
                                        <td><span class="badge badge-green">Paid</span></td>
                                    </tr>
                                    <tr data-month="February 2026">
                                        <td>February 2026</td>
                                        <td>₱3,500</td>
                                        <td>Feb 11</td>
                                        <td><span class="badge badge-green">Paid</span></td>
                                    </tr>
                                    <tr data-month="January 2026">
                                        <td>January 2026</td>
                                        <td>₱3,500</td>
                                        <td>—</td>
                                        <td><span class="badge badge-red">Late</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <div class="card">
                            <div class="card-head">
                                <h3>This Month</h3>
                            </div>
                            <div class="due-box">
                                <div>
                                    <div class="amt">₱3,500</div>
                                    <div class="sub">Due May 15, 2026</div>
                                </div>
                                <span class="badge badge-yellow">Pending</span>
                            </div>

                            <!-- DRAG & DROP RECEIPT UPLOAD -->
                            <div class="dropzone" id="receiptDropzone">
                                <span class="ic">📤</span>
                                Drag your GCash receipt here, or click to browse
                                <input type="file" id="receiptInput" accept="image/*,.pdf" />
                            </div>
                            <div class="file-chip" id="receiptChip">
                                <span class="fx" id="receiptFileName"></span>
                                <button id="receiptRemove" aria-label="Remove file">✕</button>
                            </div>
                            <button class="btn-primary" style="width:100%; margin-top:0.9rem;"
                                id="confirmPaymentBtn">Confirm Payment</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- PAGE: MAINTENANCE -->
            <section class="page" id="page-maintenance">
                <div class="page-head">
                    <div>
                        <h1>Maintenance</h1>
                        <p>Report an issue in your room or shared spaces.</p>
                    </div>
                    <button class="btn-primary" data-open-modal="requestModal">+ New Request</button>
                </div>

                <div class="card">
                    <div class="card-head">
                        <h3>Ongoing</h3>
                    </div>
                    <div class="maint-item"
                        data-toast="Dummy action: opens full details for &quot;Leaking faucet in shared CR&quot;.">
                        <div class="maint-icon">🚿</div>
                        <div class="maint-info">
                            <h5>Leaking faucet in shared CR</h5>
                            <p>Filed May 2 · Assigned to maintenance team</p>
                        </div>
                        <span class="badge badge-yellow">Ongoing</span>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <h3>Resolved</h3>
                    </div>
                    <div class="maint-item"
                        data-toast="Dummy action: opens full details for &quot;Flickering hallway light&quot;.">
                        <div class="maint-icon">💡</div>
                        <div class="maint-info">
                            <h5>Flickering hallway light</h5>
                            <p>Filed Apr 18 · Resolved by landlord</p>
                        </div>
                        <span class="badge badge-green">Fixed</span>
                    </div>
                    <div class="maint-item"
                        data-toast="Dummy action: opens full details for &quot;Outlet not working, Room B‑4&quot;.">
                        <div class="maint-icon">🔌</div>
                        <div class="maint-info">
                            <h5>Outlet not working, Room B‑4</h5>
                            <p>Filed Mar 30 · Resolved by landlord</p>
                        </div>
                        <span class="badge badge-green">Fixed</span>
                    </div>
                </div>
            </section>

            <!-- PAGE: NOTIFICATIONS -->
            <section class="page" id="page-notifications">
                <div class="page-head">
                    <div>
                        <h1>Notifications</h1>
                        <p>Stay on top of rent reminders and updates.</p>
                    </div>
                    <button class="btn-ghost" id="markAllReadBtn">Mark all read</button>
                </div>

                <div class="card">
                    <div class="notif-item" data-mark-read>
                        <div class="notif-dot"></div>
                        <div class="notif-info">
                            <p>Rent reminder — ₱3,500 due May 15</p>
                            <small>2 hours ago</small>
                        </div>
                    </div>
                    <div class="notif-item" data-mark-read>
                        <div class="notif-dot"></div>
                        <div class="notif-info">
                            <p>Maintenance update: faucet repair scheduled</p>
                            <small>Yesterday</small>
                        </div>
                    </div>
                    <div class="notif-item read" data-mark-read>
                        <div class="notif-dot"></div>
                        <div class="notif-info">
                            <p>April payment confirmed — receipt approved</p>
                            <small>Apr 12</small>
                        </div>
                    </div>
                </div>
            </section>

            <!-- PAGE: PROFILE -->
            <section class="page" id="page-profile">
                <div class="page-head">
                    <div>
                        <h1>Profile</h1>
                        <p>Keep your account details up to date.</p>
                    </div>
                </div>

                <div class="card">
                    <div class="profile-head">
                        <div class="profile-avatar">JL</div>
                        <div>
                            <button class="btn-ghost"
                                data-toast="Dummy action: opens a file picker for your profile photo.">Change
                                photo</button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full name</label>
                            <input type="text" value="Julia Lopez" />
                        </div>
                        <div class="form-group">
                            <label>Mobile number</label>
                            <input type="text" value="09xx xxx xxxx" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" value="julia.lopez@example.com" />
                    </div>
                    <div class="form-group">
                        <label>Emergency contact</label>
                        <input type="text" placeholder="Name and number" />
                    </div>
                    <button class="btn-primary" id="saveProfileBtn">Save Changes</button>
                </div>
            </section>
        </main>
    </div>

    <!-- NEW MAINTENANCE REQUEST MODAL -->
    <div class="modal-overlay" id="requestModal">
        <div class="modal-card">
            <div class="modal-head">
                <h3>New Maintenance Request</h3>
                <button class="modal-close" data-close-modal="requestModal">✕</button>
            </div>
            <div class="form-group">
                <label>What needs attention?</label>
                <select>
                    <option>Plumbing</option>
                    <option>Electrical</option>
                    <option>Aircon</option>
                    <option>Furniture</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Describe the issue</label>
                <textarea placeholder="e.g. The sink in the shared kitchen is clogged…"></textarea>
            </div>
            <div class="form-group">
                <label>Add a photo (optional)</label>
                <div class="dropzone" id="photoDropzone">
                    <span class="ic">📷</span>
                    Drag a photo here, or click to browse
                    <input type="file" id="photoInput" accept="image/*" />
                </div>
                <div class="file-chip" id="photoChip">
                    <span class="fx" id="photoFileName"></span>
                    <button id="photoRemove" aria-label="Remove file">✕</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-ghost" data-close-modal="requestModal">Cancel</button>
                <button class="btn-primary" id="submitRequestBtn">Submit Request</button>
            </div>
        </div>
    </div>

    <!-- LOGOUT CONFIRM MODAL — reuses the same modal system as above -->
    <div class="modal-overlay" id="logoutModal">
        <div class="modal-card centered">
            <div class="logout-icon">↩️</div>
            <h3>Log out?</h3>
            <p>Are you sure you want to log out of your account?</p>
            <div class="modal-footer" style="justify-content:center;">
                <button type="button" class="btn-ghost" data-close-modal="logoutModal">Cancel</button>
                <form action="{{ route('logout.store') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn-danger">Log Out</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ROOM DETAILS MODAL — opens from a Browse Rooms card, shows landlord,
         address, amenities and a live map (same Leaflet setup as My Room). -->
    <div class="modal-overlay" id="roomDetailsModal">
        <div class="modal-card">
            <div class="modal-head">
                <h3 id="rdName">Room</h3>
                <button class="modal-close" data-close-modal="roomDetailsModal">✕</button>
            </div>
            <div class="room-hero">
                <div class="room-thumb">🏠</div>
                <div class="room-info">
                    <h4 id="rdProperty"></h4>
                    <p id="rdAddress"></p>
                    <p id="rdLandlord"></p>
                    <span class="badge badge-blue" id="rdPrice"></span>
                </div>
            </div>
            <div class="detail-list" id="rdDetails"></div>
            <div class="room-map" id="rdMap"></div>
            <a href="#" id="rdDirectionsLink" target="_blank" rel="noopener" class="map-link">Get directions
                ↗</a>
            <div class="modal-footer">
                <button class="btn-ghost" data-close-modal="roomDetailsModal">Close</button>
                <button class="btn-primary" id="rdReserveBtn">Send Reservation Request</button>
            </div>
        </div>
    </div>

    <div class="toast-wrap" id="toastWrap"></div>

    <!-- Leaflet + OpenStreetMap — free, no API key required -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        /* ───────────────────────────────────────────
                           NOTE FOR BACKEND INTEGRATION:
                           Every dummy alert/toast below is marked so you
                           can swap it for a real fetch()/axios call once
                           your endpoints are ready. Nothing here talks to
                           a server yet — except the logout form, which
                           already posts to {{ route('logout.store') }}.
                        ─────────────────────────────────────────── */

        // Theme toggle
        const toggle = document.getElementById('themeToggle');
        const icon = document.getElementById('themeIcon');
        const html = document.documentElement;
        toggle.addEventListener('click', () => {
            const isDark = html.getAttribute('data-theme') === 'dark';
            html.setAttribute('data-theme', isDark ? 'light' : 'dark');
            icon.textContent = isDark ? '☀️' : '🌙';
        });

        // Toast helper
        function showToast(message) {
            const wrap = document.getElementById('toastWrap');
            const t = document.createElement('div');
            t.className = 'toast';
            t.textContent = message;
            wrap.appendChild(t);
            setTimeout(() => t.remove(), 3200);
        }

        // ── ROOM LOCATION MAP (Leaflet + OpenStreetMap) ──
        // TODO: swap the data-lat / data-lng on #roomMap with the room's
        // real GPS coordinates once you have them from your backend.
        let roomMap;
        const roomMapEl = document.getElementById('roomMap');
        if (roomMapEl) {
            const lat = parseFloat(roomMapEl.dataset.lat);
            const lng = parseFloat(roomMapEl.dataset.lng);
            roomMap = L.map('roomMap', {
                scrollWheelZoom: false
            }).setView([lat, lng], 16);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(roomMap);
            L.marker([lat, lng]).addTo(roomMap)
                .bindPopup('Sunview Boarding House · Room B‑4')
                .openPopup();
        }

        // ── PAGE NAVIGATION ──
        // Clicking a sidebar link swaps which <section class="page"> is
        // shown in the main panel — no more scrolling to an anchor.
        function goToPage(pageId) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.side-link[data-page]').forEach(l => l.classList.remove('active'));
            const target = document.getElementById('page-' + pageId);
            const link = document.querySelector('.side-link[data-page="' + pageId + '"]');
            if (target) target.classList.add('active');
            if (link) link.classList.add('active');
            document.querySelector('.main').scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            closeSidebar();
            // Leaflet needs a nudge to redraw correctly after being hidden
            if (pageId === 'dashboard' && roomMap) setTimeout(() => roomMap.invalidateSize(), 200);
        }

        document.querySelectorAll('.side-link[data-page]').forEach(link => {
            link.addEventListener('click', () => goToPage(link.dataset.page));
        });

        // Any element with data-page-link acts as an in-app shortcut too
        // (e.g. "Full history" inside a dashboard card jumps to Payments)
        document.querySelectorAll('[data-page-link]').forEach(el => {
            el.addEventListener('click', () => goToPage(el.dataset.pageLink));
        });

        // Bell icon + user chip act as nav shortcuts
        document.getElementById('bellBtn').addEventListener('click', () => goToPage('notifications'));
        document.getElementById('userChip').addEventListener('click', () => goToPage('profile'));

        // ── MOBILE SIDEBAR ──
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        function openSidebar() {
            sidebar.classList.add('open');
            backdrop.classList.add('show');
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            backdrop.classList.remove('show');
        }
        menuBtn.addEventListener('click', () => sidebar.classList.contains('open') ? closeSidebar() : openSidebar());
        backdrop.addEventListener('click', closeSidebar);

        // ── MODAL (shared by "New Request" and "Log Out") ──
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        document.querySelectorAll('[data-open-modal]').forEach(btn => {
            btn.addEventListener('click', () => openModal(btn.dataset.openModal));
        });
        document.querySelectorAll('[data-close-modal]').forEach(btn => {
            btn.addEventListener('click', () => closeModal(btn.dataset.closeModal));
        });
        // Click on the dark backdrop closes whichever modal it belongs to
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) closeModal(overlay.id);
            });
        });
        // Esc closes any open modal
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay.active').forEach(m => closeModal(m.id));
            }
        });

        // ── GENERIC DRAG & DROP HELPER ──
        // Wires up a dropzone + hidden file input + a "file chip" preview.
        // Works for both the payment receipt and the maintenance photo.
        function setupDropzone({
            zoneId,
            inputId,
            chipId,
            nameId,
            removeId,
            onFile
        }) {
            const zone = document.getElementById(zoneId);
            const input = document.getElementById(inputId);
            const chip = document.getElementById(chipId);
            const nameEl = document.getElementById(nameId);
            const removeBtn = document.getElementById(removeId);

            function acceptFile(file) {
                if (!file) return;
                nameEl.textContent = file.name;
                chip.classList.add('show');
                if (onFile) onFile(file);
            }

            zone.addEventListener('click', () => input.click());
            input.addEventListener('change', () => acceptFile(input.files[0]));

            ['dragenter', 'dragover'].forEach(evt => {
                zone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    zone.classList.add('drag-over');
                });
            });
            ['dragleave', 'dragend'].forEach(evt => {
                zone.addEventListener(evt, () => zone.classList.remove('drag-over'));
            });
            zone.addEventListener('drop', (e) => {
                e.preventDefault();
                zone.classList.remove('drag-over');
                if (e.dataTransfer.files.length) acceptFile(e.dataTransfer.files[0]);
            });
            removeBtn.addEventListener('click', () => {
                input.value = '';
                chip.classList.remove('show');
            });
        }

        setupDropzone({
            zoneId: 'receiptDropzone',
            inputId: 'receiptInput',
            chipId: 'receiptChip',
            nameId: 'receiptFileName',
            removeId: 'receiptRemove',
            onFile: () => showToast('Receipt attached — ready to confirm.')
        });

        setupDropzone({
            zoneId: 'photoDropzone',
            inputId: 'photoInput',
            chipId: 'photoChip',
            nameId: 'photoFileName',
            removeId: 'photoRemove'
        });

        document.getElementById('confirmPaymentBtn').addEventListener('click', () => {
            showToast('Dummy action: this would submit your payment for review.');
        });

        document.getElementById('submitRequestBtn').addEventListener('click', () => {
            showToast('Dummy action: this would create the maintenance request.');
            closeModal('requestModal');
        });

        // ── GETTING STARTED CHECKLIST ──
        document.querySelectorAll('.check-item:not(.done)').forEach(item => {
            item.addEventListener('click', () => {
                if (item.dataset.pageLink) goToPage(item.dataset.pageLink);
            });
        });

        // ── GENERIC "DUMMY" ELEMENTS ──
        document.querySelectorAll('[data-toast]').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                showToast(el.dataset.toast);
            });
        });

        // Payment history rows
        document.querySelectorAll('#paymentHistoryBody tr').forEach(row => {
            row.addEventListener('click', () => {
                showToast(`Dummy action: shows the receipt/details for ${row.dataset.month}.`);
            });
        });

        // Notification items — click to mark read
        document.querySelectorAll('[data-mark-read]').forEach(item => {
            item.addEventListener('click', () => item.classList.add('read'));
        });
        document.getElementById('markAllReadBtn').addEventListener('click', () => {
            document.querySelectorAll('[data-mark-read]').forEach(i => i.classList.add('read'));
            showToast('All notifications marked as read.');
        });

        // Browse room cards — clicking one opens the Room Details modal
        // TODO: replace browseRoomsData with real listings from your backend.
        const browseRoomsData = {
            a1: {
                name: 'Room A‑1',
                property: 'Green Nest Residences',
                address: '45 Commonwealth Ave, Quezon City',
                landlord: 'Landlord: Melinda R.',
                price: '₱3,000/mo',
                availability: '1 of 2 beds open',
                amenities: 'Wifi, Electric fan, Shared CR',
                lat: 14.6760,
                lng: 121.0437
            },
            c2: {
                name: 'Bed Space, C‑2',
                property: 'Riverside Dorm',
                address: 'F. Legaspi St, Pasig City',
                landlord: 'Landlord: Arnel S.',
                price: '₱2,200/mo',
                availability: '2 of 4 beds open',
                amenities: 'Wifi, Aircon, Shared kitchen',
                lat: 14.5764,
                lng: 121.0851
            },
            d3: {
                name: 'Room D‑3',
                property: 'Sunview Boarding House II',
                address: 'Alabang‑Zapote Rd, Las Piñas',
                landlord: 'Landlord: Rodrigo D.',
                price: '₱3,800/mo',
                availability: '2 of 2 beds open',
                amenities: 'Wifi, Aircon, CR, Study desk',
                lat: 14.4499,
                lng: 120.9829
            }
        };

        let rdMap, rdMarker;

        function openRoomDetails(id) {
            const data = browseRoomsData[id];
            if (!data) return;

            document.getElementById('rdName').textContent = data.name;
            document.getElementById('rdProperty').textContent = data.property;
            document.getElementById('rdAddress').textContent = data.address;
            document.getElementById('rdLandlord').textContent = data.landlord;
            document.getElementById('rdPrice').textContent = data.price;
            document.getElementById('rdDetails').innerHTML = `
                <div class="detail-row"><span>Availability</span><span>${data.availability}</span></div>
                <div class="detail-row"><span>Amenities</span><span>${data.amenities}</span></div>
            `;
            document.getElementById('rdDirectionsLink').href =
                `https://www.openstreetmap.org/?mlat=${data.lat}&mlon=${data.lng}#map=17/${data.lat}/${data.lng}`;
            document.getElementById('rdReserveBtn').dataset.roomName = data.name;

            openModal('roomDetailsModal');

            // Leaflet needs the modal visible before it can measure the map container
            setTimeout(() => {
                if (!rdMap) {
                    rdMap = L.map('rdMap', {
                        scrollWheelZoom: false
                    }).setView([data.lat, data.lng], 16);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(rdMap);
                } else {
                    rdMap.invalidateSize();
                    rdMap.setView([data.lat, data.lng], 16);
                }
                if (rdMarker) rdMarker.remove();
                rdMarker = L.marker([data.lat, data.lng]).addTo(rdMap)
                    .bindPopup(data.property)
                    .openPopup();
            }, 80);
        }

        document.querySelectorAll('#browseGrid .browse-card').forEach(card => {
            card.addEventListener('click', () => openRoomDetails(card.dataset.roomId));
        });

        document.getElementById('rdReserveBtn').addEventListener('click', () => {
            showToast(
                `Dummy action: sends a reservation request for "${document.getElementById('rdReserveBtn').dataset.roomName}".`
            );
            closeModal('roomDetailsModal');
        });

        // Browse filter chips (dummy — just toggles active state)
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
            });
        });

        // Save profile
        document.getElementById('saveProfileBtn').addEventListener('click', () => {
            showToast('Dummy action: this would save your profile changes.');
        });
    </script>
</body>

</html>
