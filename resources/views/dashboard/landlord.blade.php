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
    <link rel="stylesheet" href="{{ asset('css/landlord.css') }}">

    <!-- Leaflet + OpenStreetMap — free, no API key required -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        /* =========================================
   logout css
========================================= */

        .owner-chip {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .owner-chip:hover {
            background: rgba(255, 193, 7, 0.10);
        }

        .owner-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(135deg, #f5c542, #d9a928);
            color: #fff;

            font-size: 16px;
            font-weight: 700;

            flex-shrink: 0;
        }

        .owner-info {
            min-width: 0;
            flex: 1;
        }

        .owner-name {
            font-size: 14px;
            font-weight: 700;
            color: #222;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .owner-role {
            margin-top: 2px;
            font-size: 12px;
            color: #888;
        }

        .owner-arrow {
            font-size: 22px;
            color: #999;
            line-height: 1;
        }


        /* =========================================
   LOGOUT OVERLAY
========================================= */

        .logout-overlay {
            position: fixed;
            inset: 0;

            display: none;
            align-items: center;
            justify-content: center;

            background: rgba(0, 0, 0, 0.45);

            backdrop-filter: blur(5px);

            z-index: 9999;

            padding: 20px;
        }

        .logout-overlay.active {
            display: flex;
        }


        /* =========================================
   LOGOUT MODAL
========================================= */

        .logout-modal {
            position: relative;

            width: 100%;
            max-width: 390px;

            background: #fff;

            border-radius: 22px;

            padding: 32px;

            text-align: center;

            box-shadow:
                0 25px 70px rgba(0, 0, 0, 0.20);

            animation: logoutPop 0.25s ease;
        }

        @keyframes logoutPop {

            from {
                opacity: 0;
                transform: translateY(15px) scale(0.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

        }


        /* =========================================
   CLOSE BUTTON
========================================= */

        .logout-close {
            position: absolute;

            top: 14px;
            right: 16px;

            width: 32px;
            height: 32px;

            border: none;
            background: transparent;

            font-size: 25px;
            color: #999;

            cursor: pointer;

            border-radius: 50%;

            transition: 0.2s;
        }

        .logout-close:hover {
            background: #f5f5f5;
            color: #333;
        }


        /* =========================================
   LOGOUT ICON
========================================= */

        .logout-icon {
            width: 65px;
            height: 65px;

            margin: 0 auto 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #fff7d6;

            font-size: 28px;

            box-shadow: 0 8px 20px rgba(245, 197, 66, 0.18);
        }


        /* =========================================
   TEXT
========================================= */

        .logout-modal h3 {
            margin: 0;

            font-size: 22px;
            font-weight: 700;

            color: #222;
        }

        .logout-modal p {
            margin: 9px 0 25px;

            font-size: 14px;
            line-height: 1.6;

            color: #777;
        }


        /* =========================================
   BUTTONS
========================================= */

        .logout-actions {
            display: flex;
            gap: 10px;
        }

        .logout-actions button {
            flex: 1;

            height: 45px;

            border-radius: 11px;

            font-size: 14px;
            font-weight: 600;

            cursor: pointer;

            transition: all 0.2s ease;
        }

        .logout-actions form {
            flex: 1;
            display: flex;
            margin: 0;
        }

        .logout-cancel {
            border: 1px solid #e5e5e5;

            background: #fff;

            color: #555;
        }

        .logout-cancel:hover {
            background: #f7f7f7;
        }

        .logout-confirm {
            width: 100%;
            border: none;

            background: #f5c542;

            color: #fff;

            box-shadow: 0 6px 15px rgba(245, 197, 66, 0.25);
        }

        .logout-confirm:hover {
            background: #e3b329;

            transform: translateY(-1px);
        }


        /* =========================================
   MOBILE
========================================= */

        @media (max-width: 480px) {

            .logout-modal {
                padding: 28px 22px;
            }

            .logout-actions {
                flex-direction: column-reverse;
            }

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
                <select id="propertySelect"></select>
                <div class="property-address" id="propertyAddress"></div>
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
                <button class="navlink" data-view="settings">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                        <path
                            d="M19.4 13a7.6 7.6 0 0 0 .1-2l2-1.5-2-3.4-2.3.9a7.7 7.7 0 0 0-1.7-1l-.3-2.5h-4l-.3 2.5a7.7 7.7 0 0 0-1.7 1l-2.3-.9-2 3.4 2 1.5a7.6 7.6 0 0 0 0 2l-2 1.5 2 3.4 2.3-.9a7.7 7.7 0 0 0 1.7 1l.3 2.5h4l.3-2.5a7.7 7.7 0 0 0 1.7-1l2.3.9 2-3.4-2-1.5z"
                            stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                    </svg>
                    Settings
                </button>
            </nav>

            <div class="sidebar-foot">
                <div class="owner-chip" onclick="openLogoutModal()">

                    <div class="owner-avatar">
                        {{ strtoupper(substr(auth()->user()->email ?? 'U', 0, 1)) }}
                    </div>

                    <div class="owner-info">
                        <div class="owner-name">
                            {{ auth()->user()->email }}
                        </div>

                        <div class="owner-role">
                            Property Owner
                        </div>
                    </div>

                    <div class="owner-arrow">
                        ⋮
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
                        <input class="search-input" id="tenantSearch" placeholder="Search unit, tenant or address…">
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
                        <div style="display:flex; gap:8px;">
                            <button class="btn btn-ghost btn-sm" id="exportCsvBtn">⬇ Export CSV</button>
                            <button class="btn btn-primary btn-sm" id="recordPaymentBtn">+ Record payment</button>
                        </div>
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

            <!-- SETTINGS -->
            <div class="view" id="view-settings">
                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Property locations</h2>
                            <div class="sub">Pin each property on the map — free, powered by OpenStreetMap, no API
                                key needed</div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="addLocationBtn">+ Add property location</button>
                    </div>
                    <div id="locationsList"></div>
                </section>
            </div>

        </main>
    </div>

    <!-- ========================================= -->
    <!-- LOGOUT MODAL (moved out of the sidebar) -->

    <!-- ========================================= -->
    <div class="logout-overlay" id="logoutModal">

        <div class="logout-modal">

            <button class="logout-close" onclick="closeLogoutModal()">
                ×
            </button>

            <div class="logout-icon">
                🚪
            </div>

            <h3>Ready to leave?</h3>

            <p>
                Are you sure you want to log out of your account?
            </p>

            <div class="logout-actions">

                <button type="button" class="logout-cancel" onclick="closeLogoutModal()">
                    Cancel
                </button>

                <form method="POST" action="{{ route('logout.store') }}">
                    @csrf

                    <button type="submit" class="logout-confirm">
                        Yes, Log Out
                    </button>
                </form>

            </div>

        </div>

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

    <!-- Location modal -->
    <div class="modal-overlay" id="locationModal">
        <div class="modal" style="max-width:520px;">
            <h3 id="locModalTitle">Add property location</h3>
            <div class="modal-sub">Search an address or click the map to drop a pin.</div>
            <div class="field">
                <label>Property name</label>
                <input type="text" id="locName" placeholder="e.g. Casa Marbella Apartments">
                <input type="hidden" id="locOriginalName">
            </div>
            <div class="field">
                <label>Search address</label>
                <div style="display:flex; gap:8px;">
                    <input type="text" id="locSearch" placeholder="Search OpenStreetMap…" style="flex:1;">
                    <button class="btn btn-ghost btn-sm" id="locSearchBtn" type="button">Search</button>
                </div>
            </div>
            <div id="settingsMapContainer"
                style="height:260px; border-radius:10px; overflow:hidden; border:1px solid var(--line); margin-bottom:14px;">
            </div>
            <input type="hidden" id="locLat">
            <input type="hidden" id="locLng">
            <div class="field">
                <label>Address</label>
                <input type="text" id="locAddress" placeholder="Pin an address above, or type it manually">
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" data-close="locationModal">Cancel</button>
                <button class="btn btn-primary" id="locSave">Save location</button>
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>



    <!-- Leaflet + OpenStreetMap — free, no API key required -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        (function() {

            // ---------- Property locations (sample/dummy data) ----------
            const PROPERTIES = {
                'Casa Marbella Apartments': {
                    address: '142 Amang Rodriguez Ave, Brgy. Manggahan, Pasig City, 1611 Metro Manila',
                    lat: 14.5901,
                    lng: 121.0897
                },
                'Sampaguita Duplex (2 units)': {
                    address: '27 Sampaguita St, Brgy. Kapitolyo, Pasig City, 1603 Metro Manila',
                    lat: 14.5657,
                    lng: 121.0583
                }
            };

            function mapLink(address) {
                return 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(address);
            }

            function renderPropertyInfo() {
                const name = document.getElementById('propertySelect').value;
                const info = PROPERTIES[name];
                if (!info) return;
                document.getElementById('viewEyebrow').textContent = name;
                document.getElementById('propertyAddress').innerHTML = `
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
        <path d="M12 21s7-6.2 7-11.5A7 7 0 0 0 5 9.5C5 14.8 12 21 12 21z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
        <circle cx="12" cy="9.5" r="2.4" stroke="currentColor" stroke-width="1.8"/>
      </svg>
      <span>${info.address} · <a href="${mapLink(info.address)}" target="_blank" rel="noopener">View map</a></span>`;
            }
            document.getElementById('propertySelect').addEventListener('change', renderPropertyInfo);

            // Rebuild the sidebar property dropdown from PROPERTIES (used at init and after Settings edits)
            function refreshPropertySelectOptions() {
                const sel = document.getElementById('propertySelect');
                const current = sel.value;
                sel.innerHTML = Object.keys(PROPERTIES).map(n => `<option value="${n}">${n}</option>`).join('');
                if (PROPERTIES[current]) sel.value = current;
                renderPropertyInfo();
            }

            // ---------- Settings: property location manager (Leaflet + OpenStreetMap, free) ----------
            let settingsMap = null;
            let settingsMarker = null;
            const PASIG_CENTER = [14.5764, 121.0851];

            function renderLocationsList() {
                const names = Object.keys(PROPERTIES);
                document.getElementById('locationsList').innerHTML = names.length ? names.map(name => {
                        const info = PROPERTIES[name];
                        return `
        <div class="receipt" style="border-style:solid;">
          <div class="receipt-meta">
            <div class="who">${name}</div>
            <div class="what"><a href="${mapLink(info.address)}" target="_blank" rel="noopener">${info.address}</a></div>
          </div>
          <div class="receipt-action">
            <button class="btn btn-ghost btn-sm edit-loc-btn" data-name="${name}">Edit on map</button>
          </div>
        </div>`;
                    }).join('') :
                    `<div class="empty-state"><div class="em-title">No properties yet</div>Add one to pin it on the map.</div>`;

                document.querySelectorAll('.edit-loc-btn').forEach(btn => {
                    btn.addEventListener('click', () => openLocationModal(btn.dataset.name));
                });
            }

            function initSettingsMap() {
                if (settingsMap) return;
                settingsMap = L.map('settingsMapContainer').setView(PASIG_CENTER, 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors',
                    maxZoom: 19
                }).addTo(settingsMap);
                settingsMap.on('click', (e) => {
                    setLocationMarker(e.latlng.lat, e.latlng.lng);
                    reverseGeocode(e.latlng.lat, e.latlng.lng);
                });
            }

            function setLocationMarker(lat, lng) {
                if (settingsMarker) settingsMap.removeLayer(settingsMarker);
                settingsMarker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(settingsMap);
                settingsMarker.on('dragend', () => {
                    const pos = settingsMarker.getLatLng();
                    document.getElementById('locLat').value = pos.lat.toFixed(6);
                    document.getElementById('locLng').value = pos.lng.toFixed(6);
                    reverseGeocode(pos.lat, pos.lng);
                });
                document.getElementById('locLat').value = lat.toFixed(6);
                document.getElementById('locLng').value = lng.toFixed(6);
            }

            function reverseGeocode(lat, lng) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(r => r.json())
                    .then(data => {
                        if (data && data.display_name) {
                            document.getElementById('locAddress').value = data.display_name;
                        }
                    })
                    .catch(() => {
                        /* OSM lookup failed — leave the address field editable */
                    });
            }

            function searchLocationAddress() {
                const q = document.getElementById('locSearch').value.trim();
                if (!q) return;
                fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(q)}`)
                    .then(r => r.json())
                    .then(data => {
                        if (data && data[0]) {
                            const lat = parseFloat(data[0].lat);
                            const lng = parseFloat(data[0].lon);
                            settingsMap.setView([lat, lng], 16);
                            setLocationMarker(lat, lng);
                            document.getElementById('locAddress').value = data[0].display_name;
                        } else {
                            toast('No results found for that address');
                        }
                    })
                    .catch(() => toast('Search failed — check your connection'));
            }

            function openLocationModal(name) {
                const info = name ? PROPERTIES[name] : null;
                document.getElementById('locModalTitle').textContent = name ? 'Edit property location' :
                    'Add property location';
                document.getElementById('locName').value = name || '';
                document.getElementById('locOriginalName').value = name || '';
                document.getElementById('locAddress').value = info ? info.address : '';
                document.getElementById('locSearch').value = '';
                document.getElementById('locLat').value = info ? info.lat : '';
                document.getElementById('locLng').value = info ? info.lng : '';
                openModal('locationModal');
                setTimeout(() => {
                    initSettingsMap();
                    if (settingsMarker) {
                        settingsMap.removeLayer(settingsMarker);
                        settingsMarker = null;
                    }
                    if (info) {
                        settingsMap.setView([info.lat, info.lng], 16);
                        setLocationMarker(info.lat, info.lng);
                    } else {
                        settingsMap.setView(PASIG_CENTER, 13);
                    }
                    settingsMap.invalidateSize();
                }, 60);
            }

            document.getElementById('addLocationBtn').addEventListener('click', () => openLocationModal(null));
            document.getElementById('locSearchBtn').addEventListener('click', searchLocationAddress);
            document.getElementById('locSearch').addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchLocationAddress();
                }
            });

            document.getElementById('locSave').addEventListener('click', () => {
                const name = document.getElementById('locName').value.trim();
                const address = document.getElementById('locAddress').value.trim();
                const lat = parseFloat(document.getElementById('locLat').value);
                const lng = parseFloat(document.getElementById('locLng').value);
                if (!name || !address || isNaN(lat) || isNaN(lng)) {
                    toast('Give it a name and drop a pin on the map first');
                    return;
                }
                const originalName = document.getElementById('locOriginalName').value;
                if (originalName && originalName !== name) {
                    delete PROPERTIES[originalName];
                }
                PROPERTIES[name] = {
                    address,
                    lat,
                    lng
                };
                refreshPropertySelectOptions();
                renderLocationsList();
                closeModal('locationModal');
                toast(`Location saved for ${name} ✓`);
            });

            // ---------- Data ----------
            let units = [{
                    id: 'A1',
                    tenant: 'Marisol Dela Peña',
                    rent: 12000,
                    leaseEnds: '2027-01-31',
                    status: 'paid',
                    avatar: 'M',
                    address: 'Casa Marbella Apts, Unit A1, Amang Rodriguez Ave, Brgy. Manggahan, Pasig City'
                },
                {
                    id: 'A2',
                    tenant: 'Jun Torralba',
                    rent: 11000,
                    leaseEnds: '2026-12-15',
                    status: 'paid',
                    avatar: 'J',
                    address: 'Casa Marbella Apts, Unit A2, Amang Rodriguez Ave, Brgy. Manggahan, Pasig City'
                },
                {
                    id: 'A3',
                    tenant: 'Ella Ramoso',
                    rent: 12500,
                    leaseEnds: '2026-09-30',
                    status: 'due',
                    avatar: 'E',
                    address: 'Casa Marbella Apts, Unit A3, Amang Rodriguez Ave, Brgy. Manggahan, Pasig City'
                },
                {
                    id: 'B1',
                    tenant: 'Carlo Nieves',
                    rent: 10500,
                    leaseEnds: '2027-03-01',
                    status: 'overdue',
                    avatar: 'C',
                    address: 'Casa Marbella Apts, Unit B1, Amang Rodriguez Ave, Brgy. Manggahan, Pasig City'
                },
                {
                    id: 'B2',
                    tenant: 'Fatima Uy',
                    rent: 13000,
                    leaseEnds: '2026-11-20',
                    status: 'paid',
                    avatar: 'F',
                    address: 'Casa Marbella Apts, Unit B2, Amang Rodriguez Ave, Brgy. Manggahan, Pasig City'
                },
                {
                    id: 'B3',
                    tenant: null,
                    rent: 11500,
                    leaseEnds: null,
                    status: 'vacant',
                    avatar: '',
                    address: 'Casa Marbella Apts, Unit B3, Amang Rodriguez Ave, Brgy. Manggahan, Pasig City'
                },
                {
                    id: 'C1',
                    tenant: 'Renz Ababon',
                    rent: 12000,
                    leaseEnds: '2027-05-10',
                    status: 'overdue',
                    avatar: 'R',
                    address: 'Casa Marbella Apts, Unit C1, Amang Rodriguez Ave, Brgy. Manggahan, Pasig City'
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
            const views = ['overview', 'tenants', 'ledger', 'maintenance', 'notices', 'settings'];
            const titles = {
                overview: 'Overview',
                tenants: 'Units & Tenants',
                ledger: 'Rent Ledger',
                maintenance: 'Maintenance',
                notices: 'Notices',
                settings: 'Settings'
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
                const actions = p.status !== 'paid' ? `
        <div class="receipt-action">
          <button class="btn btn-ghost btn-sm remind-btn" data-unit="${p.unit}">Remind</button>
          <button class="btn btn-ghost btn-sm mark-paid" data-unit="${p.unit}">Mark paid</button>
        </div>` : '';
                return `
      <div class="receipt ${statusClass}" data-unit="${p.unit}">
        <div class="receipt-amt mono">${peso(p.amount)}</div>
        <div class="receipt-meta">
          <div class="who"><span class="unit-tag">${p.unit}</span> &nbsp;${p.tenant}</div>
          <div class="what">${p.status==='paid' ? 'Received '+formatDate(p.date) : 'Rent due Aug 5, 2026'}</div>
        </div>
        ${actions}
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
                attachReceiptActions();
            }

            function attachReceiptActions() {
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
                document.querySelectorAll('.remind-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        openReminderFor(btn.dataset.unit);
                    });
                });
            }

            function openReminderFor(unitId) {
                populateTenantSelects();
                const u = units.find(x => x.id === unitId);
                const p = payments.find(x => x.unit === unitId);
                if (!u) return;
                document.getElementById('ntTenant').value = unitId;
                const overdue = p && p.status === 'overdue';
                document.getElementById('ntSubject').value = overdue ?
                    `Rent reminder — overdue for ${u.id}` :
                    `Rent reminder — due Aug 5, 2026`;
                document.getElementById('ntMessage').value =
                    `Hi ${u.tenant}, just a friendly reminder that rent for ${u.id} (${peso(u.rent)}) is ${overdue ? 'now overdue' : 'due soon'}. Please let me know once it's settled. Thank you!`;
                openModal('noticeModal');
            }

            // ---------- Tenants ----------
            function renderTenants(filter) {
                const q = (filter || '').toLowerCase();
                const rows = units.filter(u => {
                    if (!q) return true;
                    return u.id.toLowerCase().includes(q) ||
                        (u.tenant || '').toLowerCase().includes(q) ||
                        (u.address || '').toLowerCase().includes(q);
                });
                document.getElementById('tenantsBody').innerHTML = rows.map(u => {
                        if (u.status === 'vacant') {
                            return `<tr class="tenant-row">
          <td data-label="Unit"><span class="unit-tag">${u.id}</span></td>
          <td data-label="Tenant" colspan="1" style="color:var(--ink-soft);">
            — vacant —
            <div class="addr-note"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M12 21s7-6.2 7-11.5A7 7 0 0 0 5 9.5C5 14.8 12 21 12 21z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>${u.address}</div>
          </td>
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
            <div>${u.tenant}
              <div class="lease-note">Lease ends ${formatDate(u.leaseEnds)}</div>
              <div class="addr-note"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M12 21s7-6.2 7-11.5A7 7 0 0 0 5 9.5C5 14.8 12 21 12 21z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>${u.address}</div>
            </div>
          </div>
        </td>
        <td data-label="Rent" class="mono">${peso(u.rent)}</td>
        <td data-label="Lease ends">${formatDate(u.leaseEnds)}</td>
        <td data-label="Status"><span class="status-pill ${u.status}">${u.status.charAt(0).toUpperCase()+u.status.slice(1)}</span></td>
      </tr>`;
                    }).join('') ||
                    `<tr><td colspan="5"><div class="empty-state"><div class="em-title">No matches</div>Try a different unit, name or address.</div></td></tr>`;

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

            // ---------- Export CSV ----------
            document.getElementById('exportCsvBtn').addEventListener('click', () => {
                const rows = [
                    ['Unit', 'Tenant', 'Amount (PHP)', 'Status', 'Date received', 'Address']
                ];
                payments.forEach(p => {
                    const u = units.find(x => x.id === p.unit);
                    rows.push([
                        p.unit,
                        p.tenant || '',
                        p.amount,
                        p.status,
                        p.date || '',
                        (u && u.address) || ''
                    ]);
                });
                const csv = rows.map(r => r.map(v => `"${String(v).replace(/"/g, '""')}"`).join(',')).join(
                    '\n');
                const blob = new Blob([csv], {
                    type: 'text/csv;charset=utf-8;'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download =
                    `ledger-${document.getElementById('monthSelect').value.replace(' ', '-').toLowerCase()}.csv`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
                toast('Ledger exported ✓');
            });

            // ---------- Init ----------
            refreshPropertySelectOptions();
            renderLocationsList();
            renderStats();
            renderLedger();
            renderTenants();
            renderKanban();
            renderNotices();

        })();
    </script>
    <script>
        //logout button modal
        function openLogoutModal() {

            document.getElementById('logoutModal')
                .classList.add('active');

        }


        function closeLogoutModal() {

            document.getElementById('logoutModal')
                .classList.remove('active');

        }


        /* Close when clicking outside the modal */

        document.getElementById('logoutModal')
            .addEventListener('click', function(event) {

                if (event.target === this) {
                    closeLogoutModal();
                }

            });


        /* Close with ESC */

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                closeLogoutModal();
            }

        });
    </script>
</body>

</html>
