<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledger — Landlord Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Leaflet + OpenStreetMap -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/landlord.css') }}" />
</head>

<body>

    <div class="app">
        <div class="backdrop-sidebar" id="backdrop"></div>

        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <div class="brand-mark">L</div>
                <div>
                    <div class="brand-name">Ledger</div>
                    <div class="brand-sub">Landlord Dashboard</div>
                </div>
            </div>

            @if ($landlordProperty)
                @php
                    $propertyTypeLabels = [
                        'boarding_house' => 'Boarding House',
                        'apartment' => 'Apartment',
                        'dormitory' => 'Dormitory',
                        'bedspace' => 'Bed Space',
                        'studio_unit' => 'Studio Unit',
                    ];
                    $propertyTypeLabel =
                        $propertyTypeLabels[$landlordProperty->property_type] ?? $landlordProperty->property_type;
                @endphp
                <div class="sidebar-property-card"
                    style="background:#fff; border:1px solid var(--line); border-radius:12px; padding:14px; margin:0 0 14px;">
                    <div
                        style="display:flex; align-items:flex-start; justify-content:space-between; gap:8px; margin-bottom:6px;">
                        <div
                            style="font-size:10.5px; text-transform:uppercase; letter-spacing:.05em; color:var(--ink-soft); font-weight:700;">
                            🏠 Your Registered Property</div>
                        <button type="button" id="sidebarRegToggle" aria-expanded="true" aria-controls="sidebarRegBody"
                            style="display:flex; align-items:center; gap:0; flex-shrink:0; background:none; border:none; padding:2px; cursor:pointer; color:var(--ink-soft);">
                            <svg id="sidebarRegToggleIcon" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" style="transition:transform .2s ease;">
                                <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <div id="sidebarRegBody">
                        <div style="font-weight:700; font-size:15.5px; line-height:1.25;">
                            {{ $landlordProperty->property_name }}</div>
                        @if ($propertyTypeLabel)
                            <div style="font-size:13px; color:var(--ink-soft); margin:2px 0 8px;">
                                {{ $propertyTypeLabel }}</div>
                        @endif
                        <div style="display:flex; flex-wrap:wrap; gap:6px 10px; font-size:12.5px; color:var(--ink);">
                            @if ($landlordProperty->number_of_floors)
                                <span>🏢 {{ $landlordProperty->number_of_floors }}
                                    floor{{ $landlordProperty->number_of_floors > 1 ? 's' : '' }}</span>
                            @endif
                            @if ($landlordProperty->number_of_rooms)
                                <span>🚪 {{ $landlordProperty->number_of_rooms }}
                                    room{{ $landlordProperty->number_of_rooms > 1 ? 's' : '' }}</span>
                            @endif
                            @if ($landlordProperty->bed_per_room)
                                <span>🛏️ {{ $landlordProperty->bed_per_room }}
                                    bed{{ $landlordProperty->bed_per_room > 1 ? 's' : '' }}/room</span>
                            @endif
                            @if ($landlordProperty->monthly_rent)
                                <span>₱{{ number_format($landlordProperty->monthly_rent) }}/mo</span>
                            @endif
                        </div>
                        @if ($landlordProperty->full_address)
                            <div style="font-size:12.5px; color:var(--ink-soft); margin-top:8px;">
                                📍 {{ $landlordProperty->full_address }}</div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="helper-banner">👋 New here? Start with <strong>Overview</strong> — it shows everything at a
                glance.</div>

            @if (session('justRegistered'))
                <div class="helper-banner" style="background:var(--gold-tint, #FBF0DA); margin-top:8px;">
                    🎉 Welcome, {{ auth()->user()->email ?? 'landlord' }}! The property you filled in during sign-up is
                    already saved below in <strong>My Properties</strong> — no need to re-enter it.
                </div>
            @endif

            <nav class="navlinks">
                <button class="navlink active" data-view="overview">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none">
                        <path d="M3 11L12 4l9 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M5 10v9a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1v-9" stroke="currentColor"
                            stroke-width="2" stroke-linejoin="round" />
                    </svg>
                    Overview
                </button>
                <button class="navlink" data-view="properties">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="9" width="18" height="12" rx="1.5" stroke="currentColor"
                            stroke-width="2" />
                        <path d="M8 21v-6h8v6" stroke="currentColor" stroke-width="2" />
                        <path d="M3 9l9-6 9 6" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                    </svg>
                    My Properties
                </button>
                <button class="navlink" data-view="tenants">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none">
                        <circle cx="9" cy="8" r="3.2" stroke="currentColor" stroke-width="2" />
                        <path d="M3.5 19c.5-3.5 3-5.5 5.5-5.5s5 2 5.5 5.5" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                        <circle cx="17" cy="9" r="2.4" stroke="currentColor" stroke-width="1.8" />
                        <path d="M15.5 19c.2-2.4 1.7-3.9 3.5-4" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                    My Tenants
                </button>
                <button class="navlink" data-view="revenue">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none">
                        <rect x="4" y="3" width="16" height="18" rx="2" stroke="currentColor"
                            stroke-width="2" />
                        <path d="M8 8h8M8 12h8M8 16h5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                    Rent &amp; Revenue
                    <span class="badge" id="overdueBadge">0</span>
                </button>
                <button class="navlink" data-view="maintenance">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none">
                        <path d="M14.7 6.3a3 3 0 1 0-4.2 4.2L4 17v3h3l6.5-6.5a3 3 0 1 0 4.2-4.2l-2 2-2-1-1-2 2-2z"
                            stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                    </svg>
                    Repairs
                    <span class="badge" id="maintBadge">0</span>
                </button>
                <button class="navlink" data-view="notices">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none">
                        <path d="M4 5h16v11H9l-5 4V5z" stroke="currentColor" stroke-width="2"
                            stroke-linejoin="round" />
                    </svg>
                    Messages
                </button>
            </nav>

            <div class="sidebar-foot">
                <div class="owner-chip" onclick="openLogoutModal()">
                    <div class="owner-avatar">{{ strtoupper(substr(auth()->user()->email ?? 'U', 0, 1)) }}</div>
                    <div class="owner-info">
                        <div class="owner-name" title="{{ auth()->user()->email ?? '' }}">
                            {{ auth()->user()->email ?? 'Landlord' }}</div>
                        <div class="owner-role">Property Owner</div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="main">
            <div class="topbar">
                <div>
                    <div class="eyebrow" id="viewEyebrow">Good day! Here's how things are going.</div>
                    <h1 class="pagetitle" id="viewTitle">Overview</h1>
                </div>
                <button class="hamburger" id="hamburgerBtn" aria-label="Open menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="#2A2118" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <!-- ===================== OVERVIEW ===================== -->
            <div class="view active" id="view-overview">
                <div class="stats-grid" id="statsGrid"></div>

                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>What would you like to do?</h2>
                            <div class="panel-sub">The most common tasks, one tap away.</div>
                        </div>
                    </div>
                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                        <button class="btn btn-primary btn-lg" id="qaAddProperty">➕ Add a New Apartment</button>
                        <button class="btn btn-ghost btn-lg" id="qaRecordPayment">💰 Record a Payment</button>
                        <button class="btn btn-ghost btn-lg" id="qaNewNotice">✉️ Message a Tenant</button>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Rent collected this month</h2>
                            <div class="panel-sub" id="revenueProgressSub"></div>
                        </div>
                    </div>
                    <div class="progress-track" style="height:16px;">
                        <div class="progress-fill" id="revenueProgressFill" style="width:0%"></div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Who still owes rent</h2>
                            <div class="panel-sub">Tap "Remind" to send a friendly message.</div>
                        </div>
                        <button class="btn btn-ghost btn-sm" data-goto="revenue">See everyone</button>
                    </div>
                    <div id="overviewLedger"></div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Repairs waiting on you</h2>
                        </div>
                        <button class="btn btn-ghost btn-sm" data-goto="maintenance">See all</button>
                    </div>
                    <div id="overviewMaint"></div>
                </div>

                @if ($landlordProperty)
                    @php
                        $regTypeLabels = [
                            'boarding_house' => 'Boarding House',
                            'apartment' => 'Apartment',
                            'dormitory' => 'Dormitory',
                            'bedspace' => 'Bed Space',
                            'studio_unit' => 'Studio Unit',
                        ];
                        $regTypeLabel =
                            $regTypeLabels[$landlordProperty->property_type] ?? $landlordProperty->property_type;
                        $regAmenities = is_array($landlordProperty->amenities)
                            ? $landlordProperty->amenities
                            : (json_decode($landlordProperty->amenities ?? '[]', true) ?:
                            []);
                    @endphp
                    <div class="panel" id="regPanel">
                        <div class="panel-head">
                            <div>
                                <h2>👋 Welcome, {{ $landlordProperty->property_name }}!</h2>
                                <div class="panel-sub">Here's a copy of the property details you entered when you
                                    signed up — just to confirm everything was saved correctly.</div>
                            </div>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <button class="btn btn-ghost btn-sm" data-goto="properties">Edit in My
                                    Properties</button>
                                <button type="button" id="regPanelToggle" class="btn btn-ghost btn-sm"
                                    aria-expanded="true" aria-controls="regPanelBody"
                                    style="display:flex; align-items:center; gap:6px; flex-shrink:0;">
                                    <svg id="regPanelToggleIcon" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" style="transition:transform .2s ease;">
                                        <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span id="regPanelToggleLabel">Minimize</span>
                                </button>
                            </div>
                        </div>
                        <div id="regPanelBody">
                            <div
                                style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:16px;">
                                <div>
                                    <div
                                        style="font-size:12px; color:var(--ink-soft); font-weight:600; margin-bottom:3px;">
                                        Property name</div>
                                    <div style="font-size:15px; font-weight:600;">
                                        {{ $landlordProperty->property_name }}</div>
                                </div>
                                @if ($regTypeLabel)
                                    <div>
                                        <div
                                            style="font-size:12px; color:var(--ink-soft); font-weight:600; margin-bottom:3px;">
                                            Property type</div>
                                        <div style="font-size:15px;">{{ $regTypeLabel }}</div>
                                    </div>
                                @endif
                                @if ($landlordProperty->full_address)
                                    <div>
                                        <div
                                            style="font-size:12px; color:var(--ink-soft); font-weight:600; margin-bottom:3px;">
                                            Address</div>
                                        <div style="font-size:15px;">📍 {{ $landlordProperty->full_address }}</div>
                                    </div>
                                @endif
                                @if ($landlordProperty->number_of_floors)
                                    <div>
                                        <div
                                            style="font-size:12px; color:var(--ink-soft); font-weight:600; margin-bottom:3px;">
                                            Number of floors</div>
                                        <div style="font-size:15px;">{{ $landlordProperty->number_of_floors }}</div>
                                    </div>
                                @endif
                                @if ($landlordProperty->number_of_rooms)
                                    <div>
                                        <div
                                            style="font-size:12px; color:var(--ink-soft); font-weight:600; margin-bottom:3px;">
                                            Number of rooms</div>
                                        <div style="font-size:15px;">{{ $landlordProperty->number_of_rooms }}</div>
                                    </div>
                                @endif
                                @if ($landlordProperty->bed_per_room)
                                    <div>
                                        <div
                                            style="font-size:12px; color:var(--ink-soft); font-weight:600; margin-bottom:3px;">
                                            Beds per room</div>
                                        <div style="font-size:15px;">{{ $landlordProperty->bed_per_room }}</div>
                                    </div>
                                @endif
                                @if ($landlordProperty->monthly_rent)
                                    <div>
                                        <div
                                            style="font-size:12px; color:var(--ink-soft); font-weight:600; margin-bottom:3px;">
                                            Monthly rent</div>
                                        <div style="font-size:15px;">
                                            ₱{{ number_format($landlordProperty->monthly_rent) }}</div>
                                    </div>
                                @endif
                            </div>
                            @if (!empty($regAmenities))
                                <div style="margin-top:16px;">
                                    <div
                                        style="font-size:12px; color:var(--ink-soft); font-weight:600; margin-bottom:6px;">
                                        Amenities</div>
                                    <div style="display:flex; flex-wrap:wrap; gap:6px;">
                                        @foreach ($regAmenities as $amenity)
                                            <span class="avail-pill">{{ $amenity }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if ($landlordProperty->house_rules)
                                <div style="margin-top:16px;">
                                    <div
                                        style="display:flex; align-items:center; justify-content:space-between; margin-bottom:3px;">
                                        <div style="font-size:12px; color:var(--ink-soft); font-weight:600;">
                                            Description / House rules</div>
                                        <button type="button" id="houseRulesToggle"
                                            style="background:none; border:none; padding:0; font-size:12.5px; font-weight:600; color:var(--ink); cursor:pointer; text-decoration:underline;">
                                            Show more
                                        </button>
                                    </div>
                                    <div id="houseRulesText"
                                        style="font-size:14px; color:var(--ink); white-space:pre-line; max-height:4.2em; overflow:hidden; position:relative; transition:max-height .25s ease;">
                                        {{ $landlordProperty->house_rules }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- ===================== PROPERTIES ===================== -->
            <div class="view" id="view-properties">
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>My Properties</h2>
                            <div class="panel-sub" id="propertiesSub"></div>
                        </div>
                        <button class="btn btn-primary" id="addPropertyBtn">➕ Add New Apartment</button>
                    </div>
                    <div class="property-grid" id="propertyGrid"></div>
                </div>
            </div>

            <!-- ===================== TENANTS ===================== -->
            <div class="view" id="view-tenants">
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>My Tenants</h2>
                            <div class="panel-sub" id="occupancySub"></div>
                        </div>
                        <input class="search-input" id="tenantSearch" placeholder="Search by name or unit…">
                    </div>
                    <div id="tenantsList"></div>
                </div>
            </div>

            <!-- ===================== REVENUE / LEDGER ===================== -->
            <div class="view" id="view-revenue">
                <div class="stats-grid" id="revenueStatsGrid" style="grid-template-columns:repeat(3,1fr);"></div>
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>This Month's Rent</h2>
                            <div class="panel-sub">Tap "Mark paid" the moment you receive a payment.</div>
                        </div>
                        <div style="display:flex; gap:8px;">
                            <button class="btn btn-ghost btn-sm" id="exportCsvBtn">⬇ Download List (CSV)</button>
                            <button class="btn btn-primary btn-sm" id="recordPaymentBtn">+ Record a Payment</button>
                        </div>
                    </div>
                    <div id="fullLedger"></div>
                </div>
            </div>

            <!-- ===================== MAINTENANCE ===================== -->
            <div class="view" id="view-maintenance">
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Repairs &amp; Maintenance</h2>
                            <div class="panel-sub">Most of these are reported by your tenants from their app. Change
                                the status from the dropdown as work gets done — no dragging needed.</div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="newRequestBtn">➕ I Noticed a Problem</button>
                    </div>
                    <div id="maintList"></div>
                </div>
            </div>

            <!-- ===================== NOTICES ===================== -->
            <div class="view" id="view-notices">
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Messages to Tenants</h2>
                            <div class="panel-sub">Rent reminders and notices you've sent.</div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="newNoticeBtn">+ Write a Message</button>
                    </div>
                    <div id="noticesList"></div>
                </div>
            </div>

        </main>
    </div>

    <!-- ============ LOGOUT MODAL ============ -->
    <div class="modal-overlay" id="logoutModal">
        <div class="modal" style="max-width:380px; text-align:center;">
            <div
                style="width:60px;height:60px;margin:0 auto 14px;border-radius:50%;background:var(--gold-tint);display:flex;align-items:center;justify-content:center;font-size:26px;">
                🚪</div>
            <h3>Ready to leave?</h3>
            <div class="modal-sub">Are you sure you want to log out?</div>
            <div class="modal-actions">
                <button type="button" class="btn btn-ghost" onclick="closeLogoutModal()">Cancel</button>
                <form method="POST" action="{{ route('logout.store') }}" style="flex:1; margin:0; display:flex;">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width:100%;">Yes, Log Out</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ============ ADD / EDIT PROPERTY MODAL ============ -->
    <div class="modal-overlay" id="propertyModal">
        <div class="modal">

            <h3 id="propModalTitle">Add a New Apartment</h3>

            <div class="modal-sub">
                Fill in the details below. Tenants will be able to see this property once you save it.
            </div>

            <!-- FORM START -->
            <form action="{{ route('add-new-apartment.store') }}" method="POST" enctype="multipart/form-data"
                id="propertyForm">
                @csrf

                <!-- PROPERTY NAME -->
                <div class="field">
                    <label for="pName">Property name</label>
                    <input type="text" id="pName" name="apartment_name" placeholder="e.g. Sunview Residences"
                        value="{{ old('apartment_name') }}" required>
                    @error('apartment_name')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- PROPERTY TYPE -->
                <div class="field">
                    <label for="pType">Property type</label>
                    <select id="pType" name="room_type" required>
                        <option value="" disabled {{ old('room_type') ? '' : 'selected' }}>Select property type
                        </option>
                        <option value="Apartment" {{ old('room_type') == 'Apartment' ? 'selected' : '' }}>Apartment
                        </option>
                        <option value="Dormitory" {{ old('room_type') == 'Dormitory' ? 'selected' : '' }}>Dormitory
                        </option>
                        <option value="Bedspace" {{ old('room_type') == 'Bedspace' ? 'selected' : '' }}>Bedspace
                        </option>
                        <option value="Studio Unit" {{ old('room_type') == 'Studio Unit' ? 'selected' : '' }}>Studio
                            Unit</option>
                        <option value="Boarding House" {{ old('room_type') == 'Boarding House' ? 'selected' : '' }}>
                            Boarding House</option>
                    </select>
                    @error('room_type')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- ROOM / UNIT NAME -->
                <div class="field">
                    <label for="pRoomName">Room or unit name</label>
                    <input type="text" id="pRoomName" name="room_name" placeholder="e.g. Room 204"
                        value="{{ old('room_name') }}" required>
                    @error('room_name')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- FULL ADDRESS -->
                <div class="field">
                    <label for="pAddress">Full address</label>
                    <textarea id="pAddress" name="apartment_address" rows="2" placeholder="e.g. 123 Kalayaan Ave, Silang, Cavite"
                        required>{{ old('apartment_address') }}</textarea>
                    @error('apartment_address')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- RENT + TOTAL BEDS -->
                <div class="field-row">
                    <div class="field">
                        <label for="pRent">Monthly rent (₱)</label>
                        <input type="number" id="pRent" name="monthly_rent" placeholder="e.g. 4500"
                            min="0" step="0.01" value="{{ old('monthly_rent') }}" required>
                        @error('monthly_rent')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="pCapacity">Total beds</label>
                        <input type="number" id="pCapacity" name="total_beds_in_room" min="1"
                            value="{{ old('total_beds_in_room', 1) }}" required>
                        @error('total_beds_in_room')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- AVAILABLE BEDS -->
                <div class="field">
                    <label for="pAvailable">Available beds</label>
                    <input type="number" id="pAvailable" name="available_beds_in_room" min="0"
                        value="{{ old('available_beds_in_room', 1) }}" required>
                    <small style="color: var(--ink-soft);">Number of beds that are still available for tenants.</small>
                    @error('available_beds_in_room')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- AMENITIES -->
                <div class="field">
                    <label for="pAmenities">Amenities</label>
                    <input type="text" id="pAmenities" name="amenities"
                        placeholder="e.g. WiFi, Aircon, Shared Kitchen" value="{{ old('amenities') }}">
                    <small style="color: var(--ink-soft);">Separate each amenity with a comma.</small>
                    @error('amenities')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- PROPERTY LOCATION / MAP -->
                <div class="field">
                    <label>Property location</label>
                    <div style="font-size:13px; color:var(--ink-soft); margin-bottom:8px;">
                        Search for the property address or click directly on the map to place the location pin.
                    </div>

                    <div style="display:flex; gap:8px; margin-bottom:10px;">
                        <input type="text" id="pMapSearch" placeholder="Search property location">
                        <button type="button" class="btn btn-ghost btn-sm" id="pMapSearchBtn"
                            style="flex-shrink:0;">🔎 Find</button>
                    </div>

                    <div id="pMap"
                        style="height:220px; border-radius:12px; overflow:hidden; border:1px solid var(--line);"></div>

                    <div style="font-size:13px; color:var(--ink-soft); margin-top:6px;">
                        📍 Click anywhere on the map to place the pin. You can also drag the pin to the exact location.
                    </div>

                    <input type="hidden" id="pLat" name="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" id="pLng" name="longitude" value="{{ old('longitude') }}">
                </div>

                <!-- PROPERTY PHOTO -->
                <div class="field">
                    <label>Property photo</label>
                    <div class="photo-drop" id="pPhotoDrop">
                        📷 Click to choose a photo<br>
                        <small>Optional — a placeholder will be used if no photo is uploaded.</small>
                    </div>
                    <input type="file" id="pPhotoInput" name="apartment_image" accept="image/*"
                        style="display:none;">

                    <div id="pPhotoPreviewWrap" style="margin-top:10px; display:none;">
                        <img id="pPhotoPreview" alt="Property photo preview"
                            style="width:100%; max-height:180px; object-fit:cover; border-radius:10px;">
                    </div>
                    @error('apartment_image')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- MODAL BUTTONS -->
                <div class="modal-actions">
                    <button type="button" class="btn btn-ghost" data-close="propertyModal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="pSave">Save Apartment</button>
                </div>

            </form>
            <!-- FORM END -->

        </div>
    </div>

    <!-- ============ RECORD PAYMENT MODAL ============ -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal">
            <h3>Record a Payment</h3>
            <div class="modal-sub">Write down the rent money you received from a tenant.</div>
            <div class="field">
                <label>Which tenant paid?</label>
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
                <button class="btn btn-primary" id="pmSave">Save Payment</button>
            </div>
        </div>
    </div>

    <!-- ============ MAINTENANCE MODAL ============ -->
    <div class="modal-overlay" id="maintModal">
        <div class="modal">
            <h3>Report a Problem You Noticed</h3>
            <div class="modal-sub">Use this when <strong>you</strong> spotted something, or a tenant told you by phone
                or in person instead of through their app. It'll be labeled "Reported by you" so it's easy to tell apart
                from tenant reports.</div>
            <div class="field">
                <label>Which unit?</label>
                <select id="mmUnit"></select>
            </div>
            <div class="field">
                <label>What's the problem?</label>
                <textarea id="mmDesc" placeholder="e.g. Kitchen faucet is leaking"></textarea>
            </div>
            <div class="field">
                <label>How urgent is it?</label>
                <select id="mmPriority">
                    <option value="low">Not urgent</option>
                    <option value="med" selected>Somewhat urgent</option>
                    <option value="high">Very urgent</option>
                </select>
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" data-close="maintModal">Cancel</button>
                <button class="btn btn-primary" id="mmSave">Add Repair</button>
            </div>
        </div>
    </div>

    <!-- ============ NOTICE MODAL ============ -->
    <div class="modal-overlay" id="noticeModal">
        <div class="modal">
            <h3>Write a Message</h3>
            <div class="modal-sub">Send a reminder or note to one of your tenants.</div>
            <div class="field">
                <label>Send to</label>
                <select id="ntTenant"></select>
            </div>
            <div class="field">
                <label>Subject</label>
                <input type="text" id="ntSubject" placeholder="e.g. Rent reminder — due Sept 5">
            </div>
            <div class="field">
                <label>Your message</label>
                <textarea id="ntMessage" placeholder="Write your note to the tenant…"></textarea>
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" data-close="noticeModal">Cancel</button>
                <button class="btn btn-primary" id="ntSave">Save &amp; Send</button>
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>

    <!-- Leaflet -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        (function() {

            // Sample data (you can later replace this with real data from Laravel)
            let properties = [{
                    id: 'p1',
                    room_name: 'Room 204',
                    property_name: 'Sunview Residences',
                    address: '123 Kalayaan Ave, Mandaluyong City',
                    monthly_rent: 4500,
                    available_beds: 1,
                    bed_capacity: 2,
                    amenities: 'WiFi, Aircon, Shared Kitchen',
                    photo: 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=700&q=60',
                    latitude: 14.5794,
                    longitude: 121.0359
                },
                {
                    id: 'p2',
                    room_name: 'Room 12',
                    property_name: 'The Hub Dormitel',
                    address: '45 Boni Ave, Mandaluyong City',
                    monthly_rent: 2800,
                    available_beds: 3,
                    bed_capacity: 4,
                    amenities: 'WiFi, CR, Laundry Area',
                    photo: 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=700&q=60',
                    latitude: 14.5764,
                    longitude: 121.0410
                },
                {
                    id: 'p3',
                    room_name: 'Studio A',
                    property_name: 'Greenview Suites',
                    address: '78 Shaw Blvd, Mandaluyong City',
                    monthly_rent: 6200,
                    available_beds: 0,
                    bed_capacity: 1,
                    amenities: 'WiFi, Aircon, Private CR, Kitchenette',
                    photo: 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=700&q=60',
                    latitude: 14.5822,
                    longitude: 121.0453
                },
            ];

            const landlordRegisteredProperty = @json($landlordProperty ?? null);

            const PROPERTY_TYPE_LABELS = {
                boarding_house: 'Boarding House',
                apartment: 'Apartment',
                dormitory: 'Dormitory',
                bedspace: 'Bed Space',
                studio_unit: 'Studio Unit'
            };

            if (landlordRegisteredProperty) {
                const reg = landlordRegisteredProperty;
                const bedsPerRoom = Number(reg.bed_per_room) || 1;
                const totalRooms = Number(reg.number_of_rooms) || 1;
                const totalBeds = bedsPerRoom * totalRooms;

                properties.unshift({
                    id: 'reg-' + (reg.id || Date.now()),
                    room_name: totalRooms > 1 ? `All ${totalRooms} Rooms` : 'Room 1',
                    property_name: reg.property_name,
                    address: reg.full_address,
                    monthly_rent: Number(reg.monthly_rent) || 0,
                    available_beds: totalBeds,
                    bed_capacity: totalBeds,
                    amenities: Array.isArray(reg.amenities) ? reg.amenities.join(', ') : (reg.amenities || '—'),
                    photo: reg.photo ||
                        'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=700&q=60',
                    latitude: reg.latitude || null,
                    longitude: reg.longitude || null,
                    property_type: reg.property_type ? (PROPERTY_TYPE_LABELS[reg.property_type] || reg
                        .property_type) : null,
                    number_of_floors: reg.number_of_floors || null,
                    number_of_rooms: reg.number_of_rooms || null,
                    bed_per_room: reg.bed_per_room || null,
                    house_rules: reg.house_rules || null,
                    fromRegistration: true
                });
            }

            let units = [{
                    id: 'A1',
                    tenant: 'Marisol Dela Peña',
                    rent: 12000,
                    leaseEnds: '2027-01-31',
                    status: 'paid'
                },
                {
                    id: 'A2',
                    tenant: 'Jun Torralba',
                    rent: 11000,
                    leaseEnds: '2026-12-15',
                    status: 'paid'
                },
                {
                    id: 'A3',
                    tenant: 'Ella Ramoso',
                    rent: 12500,
                    leaseEnds: '2026-09-30',
                    status: 'due'
                },
                {
                    id: 'B1',
                    tenant: 'Carlo Nieves',
                    rent: 10500,
                    leaseEnds: '2027-03-01',
                    status: 'overdue'
                },
                {
                    id: 'B2',
                    tenant: 'Fatima Uy',
                    rent: 13000,
                    leaseEnds: '2026-11-20',
                    status: 'paid'
                },
                {
                    id: 'B3',
                    tenant: null,
                    rent: 11500,
                    leaseEnds: null,
                    status: 'vacant'
                },
                {
                    id: 'C1',
                    tenant: 'Renz Ababon',
                    rent: 12000,
                    leaseEnds: '2027-05-10',
                    status: 'overdue'
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
                    status: 'new',
                    reportedBy: 'tenant'
                },
                {
                    id: 2,
                    unit: 'A3',
                    desc: 'Aircon not cooling in bedroom',
                    priority: 'med',
                    status: 'new',
                    reportedBy: 'tenant'
                },
                {
                    id: 3,
                    unit: 'C1',
                    desc: 'Front gate lock is stiff',
                    priority: 'low',
                    status: 'progress',
                    reportedBy: 'landlord'
                },
                {
                    id: 4,
                    unit: 'A2',
                    desc: 'Replace hallway light bulb',
                    priority: 'low',
                    status: 'done',
                    reportedBy: 'landlord'
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

            const peso = n => '₱' + Number(n).toLocaleString('en-PH');
            const toastEl = document.getElementById('toast');

            function toast(msg) {
                toastEl.textContent = msg;
                toastEl.classList.add('show');
                clearTimeout(toastEl._t);
                toastEl._t = setTimeout(() => toastEl.classList.remove('show'), 2600);
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

            // ---------------- Navigation ----------------
            const views = ['overview', 'properties', 'tenants', 'revenue', 'maintenance', 'notices'];
            const titles = {
                overview: 'Overview',
                properties: 'My Properties',
                tenants: 'My Tenants',
                revenue: 'Rent & Revenue',
                maintenance: 'Repairs & Maintenance',
                notices: 'Messages to Tenants'
            };
            const eyebrows = {
                overview: "Good day! Here's how things are going.",
                properties: 'Everything you own, and everything you can add.',
                tenants: 'Everyone currently renting from you.',
                revenue: 'Money coming in — and money still owed.',
                maintenance: 'Track repairs from report to done.',
                notices: 'A record of what you have sent your tenants.'
            };

            function showView(name) {
                views.forEach(v => document.getElementById('view-' + v).classList.toggle('active', v === name));
                document.querySelectorAll('.navlink').forEach(b => b.classList.toggle('active', b.dataset.view ===
                    name));
                document.getElementById('viewTitle').textContent = titles[name];
                document.getElementById('viewEyebrow').textContent = eyebrows[name];
                closeSidebar();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
            document.querySelectorAll('.navlink').forEach(btn => btn.addEventListener('click', () => showView(btn
                .dataset.view)));
            document.querySelectorAll('[data-goto]').forEach(btn => btn.addEventListener('click', () => showView(btn
                .dataset.goto)));

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

            // ---------------- Modals ----------------
            function openModal(id) {
                document.getElementById(id).classList.add('open');
            }

            function closeModal(id) {
                document.getElementById(id).classList.remove('open');
            }
            document.querySelectorAll('[data-close]').forEach(btn => btn.addEventListener('click', () => closeModal(btn
                .dataset.close)));
            document.querySelectorAll('.modal-overlay').forEach(ov => ov.addEventListener('click', e => {
                if (e.target === ov) ov.classList.remove('open');
            }));
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') document.querySelectorAll('.modal-overlay.open').forEach(m => m
                    .classList.remove('open'));
            });

            window.openLogoutModal = () => openModal('logoutModal');
            window.closeLogoutModal = () => closeModal('logoutModal');

            // ---------------- Stats / Overview ----------------
            function renderStats() {
                const occupied = units.filter(u => u.status !== 'vacant').length;
                const vacant = units.filter(u => u.status === 'vacant').length;
                const collected = payments.filter(p => p.status === 'paid').reduce((s, p) => s + p.amount, 0);
                const outstanding = payments.filter(p => p.status !== 'paid').reduce((s, p) => s + p.amount, 0);
                const overdue = units.filter(u => u.status === 'overdue').length;
                const expected = collected + outstanding;
                const pct = expected ? Math.round((collected / expected) * 100) : 0;

                const cards = [{
                        label: 'Total Properties',
                        value: String(properties.length),
                        note: `${units.length} rooms total`
                    },
                    {
                        label: 'Rooms Occupied',
                        value: `${occupied} / ${units.length}`,
                        note: `${vacant} room${vacant===1?'':'s'} empty`
                    },
                    {
                        label: 'Money Collected',
                        value: peso(collected),
                        note: 'so far this month'
                    },
                    {
                        label: 'Money Still Owed',
                        value: peso(outstanding),
                        note: `${overdue} tenant${overdue===1?'':'s'} overdue`
                    },
                ];
                document.getElementById('statsGrid').innerHTML = cards.map(c => `
                    <div class="stat-card">
                        <div class="stat-label">${c.label}</div>
                        <div class="stat-value">${c.value}</div>
                        <div class="stat-note">${c.note}</div>
                    </div>`).join('');

                document.getElementById('revenueStatsGrid').innerHTML = `
                    <div class="stat-card"><div class="stat-label">Collected</div><div class="stat-value">${peso(collected)}</div><div class="stat-note">${payments.filter(p=>p.status==='paid').length} payments received</div></div>
                    <div class="stat-card"><div class="stat-label">Still Owed</div><div class="stat-value">${peso(outstanding)}</div><div class="stat-note">${payments.filter(p=>p.status!=='paid').length} tenants haven't paid</div></div>
                    <div class="stat-card"><div class="stat-label">Collection Progress</div><div class="stat-value">${pct}%</div>
                        <div class="progress-track"><div class="progress-fill ${pct<60?'warn':''}" style="width:${pct}%"></div></div>
                    </div>`;

                document.getElementById('revenueProgressFill').style.width = pct + '%';
                document.getElementById('revenueProgressFill').classList.toggle('warn', pct < 60);
                document.getElementById('revenueProgressSub').textContent =
                    `${peso(collected)} collected of ${peso(expected)} expected (${pct}%)`;
                document.getElementById('overdueBadge').textContent = payments.filter(p => p.status === 'overdue')
                    .length;
            }

            // ---------------- Properties ----------------
            function renderProperties() {
                document.getElementById('propertiesSub').textContent =
                    `You have ${properties.length} apartment${properties.length===1?'':'s'} listed.`;
                document.getElementById('propertyGrid').innerHTML = properties.length ? properties.map(p => {
                        const openBeds = p.available_beds > 0;
                        const regDetails = [
                            p.property_type,
                            p.number_of_floors ? `${p.number_of_floors} floor${p.number_of_floors>1?'s':''}` :
                            null,
                            p.number_of_rooms ? `${p.number_of_rooms} room${p.number_of_rooms>1?'s':''}` : null,
                            p.bed_per_room ? `${p.bed_per_room} bed${p.bed_per_room>1?'s':''}/room` : null,
                        ].filter(Boolean).join(' · ');

                        return `<div class="property-card">
                        <div class="property-photo" style="background-image:url('${p.photo || ''}')">${p.photo ? '' : '🏠'}</div>
                        <div class="property-body">
                            <h3>${p.room_name} — ${p.property_name}</h3>
                            ${p.fromRegistration ? `<span class="avail-pill" style="margin-bottom:6px; display:inline-block;">📝 From your sign-up</span>` : ''}
                            <div class="property-addr">📍 ${p.address}</div>
                            ${regDetails ? `<div style="font-size:13.5px; color:var(--ink-soft); margin-top:2px;">${regDetails}</div>` : ''}
                            <div class="property-meta">
                                <span class="property-price">${peso(p.monthly_rent)}<span style="font-size:13px; font-weight:400; color:var(--ink-soft);">/mo</span></span>
                                <span class="avail-pill ${openBeds?'':'full'}">${openBeds ? p.available_beds + ' bed' + (p.available_beds>1?'s':'') + ' open' : 'Fully booked'}</span>
                            </div>
                            <div style="font-size:13.5px; color:var(--ink-soft);">${p.amenities || '—'}</div>
                            ${p.house_rules ? `<div style="font-size:13px; color:var(--ink-soft); margin-top:6px;"><strong>House rules:</strong> ${p.house_rules}</div>` : ''}
                            ${p.latitude ? `<a href="https://www.openstreetmap.org/?mlat=${p.latitude}&mlon=${p.longitude}#map=17/${p.latitude}/${p.longitude}" target="_blank" rel="noopener" style="display:inline-block; margin-top:8px; font-size:13.5px; font-weight:600;">📍 View on map ↗</a>` : ''}
                            <button type="button" class="btn btn-ghost btn-sm edit-property-btn" data-id="${p.id}" style="width:100%; margin-top:12px;">✏️ Edit This Apartment</button>
                        </div>
                    </div>`;
                    }).join('') :
                    `<div class="empty-state"><div class="em-title">No apartments yet</div>Tap "Add New Apartment" to list your first room.</div>`;

                document.querySelectorAll('.edit-property-btn').forEach(btn => {
                    btn.addEventListener('click', () => openEditPropertyModal(btn.dataset.id));
                });
            }

            // =====================================================
            // ADD / EDIT PROPERTY MODAL — FIXED FOR LARAVEL
            // =====================================================
            let editingPropertyId = null;
            let pendingPhotoDataUrl = '';
            let pMap, pMarker;
            const MANDALUYONG_CENTER = [14.5794, 121.0359];

            document.getElementById('addPropertyBtn').addEventListener('click', openAddPropertyModal);
            document.getElementById('qaAddProperty').addEventListener('click', openAddPropertyModal);

            function openAddPropertyModal() {
                editingPropertyId = null;
                document.getElementById('propModalTitle').textContent = 'Add a New Apartment';
                document.getElementById('pSave').textContent = 'Save Apartment';

                ['pName', 'pRoomName', 'pAddress', 'pRent', 'pAmenities', 'pMapSearch'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.value = '';
                });

                document.getElementById('pCapacity').value = 1;
                document.getElementById('pAvailable').value = 1;
                document.getElementById('pType').selectedIndex = 0;
                document.getElementById('pLat').value = '';
                document.getElementById('pLng').value = '';
                document.getElementById('pPhotoPreviewWrap').style.display = 'none';
                document.getElementById('pPhotoInput').value = '';
                pendingPhotoDataUrl = '';

                openModal('propertyModal');
                setTimeout(initPropertyMap, 80);
            }

            function openEditPropertyModal(id) {
                const p = properties.find(x => x.id === id);
                if (!p) return;

                editingPropertyId = id;
                document.getElementById('propModalTitle').textContent = 'Edit This Apartment';
                document.getElementById('pSave').textContent = 'Save Changes';

                document.getElementById('pName').value = p.property_name || '';
                document.getElementById('pRoomName').value = p.room_name || '';
                document.getElementById('pAddress').value = p.address || '';
                document.getElementById('pRent').value = p.monthly_rent || '';
                document.getElementById('pCapacity').value = p.bed_capacity || 1;
                document.getElementById('pAvailable').value = p.available_beds || 0;
                document.getElementById('pAmenities').value = (p.amenities === '—') ? '' : (p.amenities || '');
                document.getElementById('pMapSearch').value = '';
                document.getElementById('pLat').value = p.latitude || '';
                document.getElementById('pLng').value = p.longitude || '';

                pendingPhotoDataUrl = p.photo || '';
                if (p.photo) {
                    document.getElementById('pPhotoPreview').src = p.photo;
                    document.getElementById('pPhotoPreviewWrap').style.display = 'block';
                } else {
                    document.getElementById('pPhotoPreviewWrap').style.display = 'none';
                }
                document.getElementById('pPhotoInput').value = '';

                openModal('propertyModal');
                setTimeout(() => {
                    initPropertyMap();
                    if (p.latitude && p.longitude) {
                        pMap.setView([p.latitude, p.longitude], 16);
                        setPropertyMarker(p.latitude, p.longitude);
                    }
                }, 80);
            }

            function initPropertyMap() {
                if (!pMap) {
                    pMap = L.map('pMap', {
                        scrollWheelZoom: false
                    }).setView(MANDALUYONG_CENTER, 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(pMap);

                    pMap.on('click', (e) => {
                        setPropertyMarker(e.latlng.lat, e.latlng.lng);
                        reverseGeocodeProperty(e.latlng.lat, e.latlng.lng);
                    });
                } else {
                    pMap.invalidateSize();
                }

                if (pMarker) {
                    pMap.removeLayer(pMarker);
                    pMarker = null;
                }
                pMap.setView(MANDALUYONG_CENTER, 13);
            }

            function setPropertyMarker(lat, lng) {
                if (pMarker) pMap.removeLayer(pMarker);
                pMarker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(pMap);

                pMarker.on('dragend', () => {
                    const pos = pMarker.getLatLng();
                    document.getElementById('pLat').value = pos.lat.toFixed(6);
                    document.getElementById('pLng').value = pos.lng.toFixed(6);
                    reverseGeocodeProperty(pos.lat, pos.lng);
                });

                document.getElementById('pLat').value = lat.toFixed(6);
                document.getElementById('pLng').value = lng.toFixed(6);
            }

            function reverseGeocodeProperty(lat, lng) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(r => r.json())
                    .then(data => {
                        if (data && data.display_name) {
                            document.getElementById('pAddress').value = data.display_name;
                        }
                    })
                    .catch(() => {});
            }

            function searchPropertyAddress() {
                const q = document.getElementById('pMapSearch').value.trim();
                if (!q) {
                    toast('Type an address first, then tap Find.');
                    return;
                }

                fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(q)}`)
                    .then(r => r.json())
                    .then(data => {
                        if (data && data[0]) {
                            const lat = parseFloat(data[0].lat);
                            const lng = parseFloat(data[0].lon);
                            pMap.setView([lat, lng], 16);
                            setPropertyMarker(lat, lng);
                            document.getElementById('pAddress').value = data[0].display_name;
                        } else {
                            toast('No results for that address — try adding the city, or drop the pin by hand.');
                        }
                    })
                    .catch(() => toast('Search failed — check your internet connection.'));
            }

            document.getElementById('pMapSearchBtn').addEventListener('click', searchPropertyAddress);
            document.getElementById('pMapSearch').addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchPropertyAddress();
                }
            });

            // Photo preview
            document.getElementById('pPhotoDrop').addEventListener('click', () => {
                document.getElementById('pPhotoInput').click();
            });

            document.getElementById('pPhotoInput').addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = () => {
                    pendingPhotoDataUrl = reader.result;
                    document.getElementById('pPhotoPreview').src = pendingPhotoDataUrl;
                    document.getElementById('pPhotoPreviewWrap').style.display = 'block';
                };
                reader.readAsDataURL(file);
            });

            // =====================================================
            // NO CLICK LISTENER ON #pSave
            // The button is type="submit" → form posts to Laravel
            // =====================================================

            // ---------------- Tenants ----------------
            function renderTenants(filter) {
                const q = (filter || '').toLowerCase();
                const rows = units.filter(u => {
                    if (!q) return true;
                    return u.id.toLowerCase().includes(q) || (u.tenant || '').toLowerCase().includes(q);
                });
                document.getElementById('tenantsList').innerHTML = rows.length ? rows.map(u => {
                        if (u.status === 'vacant') {
                            return `<div class="tenant-card">
                            <div class="avatar">—</div>
                            <div class="tenant-main"><h3>Unit ${u.id} — Vacant</h3><div class="sub">${peso(u.rent)}/mo · No tenant yet</div></div>
                            <span class="status-pill vacant">Vacant</span>
                        </div>`;
                        }
                        return `<div class="tenant-card">
                        <div class="avatar">${u.tenant.charAt(0)}</div>
                        <div class="tenant-main">
                            <h3>${u.tenant} <span style="font-weight:400; color:var(--ink-soft); font-size:15px;">· Unit ${u.id}</span></h3>
                            <div class="sub">${peso(u.rent)}/mo · Lease ends ${formatDate(u.leaseEnds)}</div>
                        </div>
                        <span class="status-pill ${u.status}">${u.status.charAt(0).toUpperCase()+u.status.slice(1)}</span>
                        <div class="tenant-actions">
                            <button class="btn btn-ghost btn-sm" onclick="toast('Opening a message to ${u.tenant.replace(/'/g,"")} (demo only).')">✉️ Message</button>
                        </div>
                    </div>`;
                    }).join('') :
                    `<div class="empty-state"><div class="em-title">No matches</div>Try a different name or unit.</div>`;

                const occ = units.filter(u => u.status !== 'vacant').length;
                document.getElementById('occupancySub').textContent = `${occ} of ${units.length} rooms are occupied.`;
            }
            document.getElementById('tenantSearch').addEventListener('input', e => renderTenants(e.target.value));

            // ---------------- Ledger / Revenue ----------------
            function receiptHTML(p) {
                const cls = p.status === 'paid' ? '' : (p.status === 'due' ? 'is-due' : 'is-overdue');
                const label = p.status === 'paid' ? 'Paid' : (p.status === 'due' ? 'Due soon' : 'Overdue');
                const actions = p.status !== 'paid' ? `
                    <div class="receipt-action">
                        <button class="btn btn-ghost btn-sm remind-btn" data-unit="${p.unit}">Remind</button>
                        <button class="btn btn-primary btn-sm mark-paid" data-unit="${p.unit}">Mark Paid</button>
                    </div>` : '';
                return `<div class="receipt ${cls}">
                    <div class="receipt-amt">${peso(p.amount)}</div>
                    <div class="receipt-meta">
                        <div class="who">${p.tenant} <span style="font-weight:400; color:var(--ink-soft);">· Unit ${p.unit}</span></div>
                        <div class="what">${p.status==='paid' ? 'Received ' + formatDate(p.date) : 'Rent due Sept 5, 2026'} · ${label}</div>
                    </div>
                    ${actions}
                </div>`;
            }

            function renderLedger() {
                const sorted = [...payments].sort((a, b) => ({
                    overdue: 0,
                    due: 1,
                    paid: 2
                } [a.status]) - ({
                    overdue: 0,
                    due: 1,
                    paid: 2
                } [b.status]));
                document.getElementById('fullLedger').innerHTML = sorted.map(receiptHTML).join('');
                document.getElementById('overviewLedger').innerHTML = sorted.filter(p => p.status !== 'paid').slice(0,
                        4).map(receiptHTML).join('') ||
                    `<div class="empty-state"><div class="em-title">Everyone has paid</div>Nice work — no reminders needed.</div>`;
                attachReceiptActions();
            }

            function attachReceiptActions() {
                document.querySelectorAll('.mark-paid').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const unit = btn.dataset.unit;
                        const p = payments.find(x => x.unit === unit);
                        if (p) {
                            p.status = 'paid';
                            p.date = new Date().toISOString().slice(0, 10);
                        }
                        const u = units.find(x => x.id === unit);
                        if (u) u.status = 'paid';
                        renderLedger();
                        renderStats();
                        renderTenants();
                        toast(`Marked Unit ${unit} as paid ✓`);
                    });
                });
                document.querySelectorAll('.remind-btn').forEach(btn => {
                    btn.addEventListener('click', () => openReminderFor(btn.dataset.unit));
                });
            }

            function openReminderFor(unitId) {
                populateTenantSelects();
                const u = units.find(x => x.id === unitId);
                const p = payments.find(x => x.unit === unitId);
                if (!u) return;
                document.getElementById('ntTenant').value = unitId;
                const overdue = p && p.status === 'overdue';
                document.getElementById('ntSubject').value = overdue ? `Rent reminder — overdue for Unit ${u.id}` :
                    `Rent reminder — due soon`;
                document.getElementById('ntMessage').value =
                    `Hi ${u.tenant}, just a friendly reminder that rent for Unit ${u.id} (${peso(u.rent)}) is ${overdue?'now overdue':'due soon'}. Please let me know once it's settled. Thank you!`;
                openModal('noticeModal');
            }

            document.getElementById('recordPaymentBtn').addEventListener('click', openPaymentModal);
            document.getElementById('qaRecordPayment').addEventListener('click', openPaymentModal);

            function openPaymentModal() {
                populateTenantSelects();
                document.getElementById('pmDate').value = new Date().toISOString().slice(0, 10);
                document.getElementById('pmAmount').value = '';
                openModal('paymentModal');
            }

            document.getElementById('pmSave').addEventListener('click', () => {
                const unitId = document.getElementById('pmTenant').value;
                const amount = Number(document.getElementById('pmAmount').value);
                const date = document.getElementById('pmDate').value;
                if (!unitId || !amount) {
                    toast('Please enter an amount first.');
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
                renderLedger();
                renderStats();
                renderTenants();
                toast(`Payment recorded for Unit ${unitId} ✓`);
            });

            document.getElementById('exportCsvBtn').addEventListener('click', () => {
                const rows = [
                    ['Unit', 'Tenant', 'Amount (PHP)', 'Status', 'Date received']
                ];
                payments.forEach(p => rows.push([p.unit, p.tenant || '', p.amount, p.status, p.date || '']));
                const csv = rows.map(r => r.map(v => `"${String(v).replace(/"/g,'""')}"`).join(',')).join('\n');
                const blob = new Blob([csv], {
                    type: 'text/csv;charset=utf-8;'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'rent-ledger.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
                toast('Your rent list has been downloaded ✓');
            });

            // ---------------- Maintenance ----------------
            const statusLabel = {
                new: 'Not started',
                progress: 'In progress',
                done: 'Done'
            };

            function renderMaintenance() {
                const order = {
                    new: 0,
                    progress: 1,
                    done: 2
                };
                const sorted = [...maintenance].sort((a, b) => order[a.status] - order[b.status]);
                document.getElementById('maintList').innerHTML = sorted.length ? sorted.map(m => `
                    <div class="maint-row">
                        <span class="pri pri-${m.priority}">${m.priority==='high'?'Very urgent':m.priority==='med'?'Somewhat urgent':'Not urgent'}</span>
                        <div class="maint-desc">
                            <h4>${m.desc}</h4>
                            <div class="sub">Unit ${m.unit} · ${m.reportedBy==='landlord' ? '🧑‍💼 Reported by you' : '🏠 Reported by tenant'}</div>
                        </div>
                        <select class="status-select" data-id="${m.id}">
                            <option value="new" ${m.status==='new'?'selected':''}>Not started</option>
                            <option value="progress" ${m.status==='progress'?'selected':''}>In progress</option>
                            <option value="done" ${m.status==='done'?'selected':''}>Done</option>
                        </select>
                    </div>`).join('') :
                    `<div class="empty-state"><div class="em-title">No repairs reported</div>You're all caught up.</div>`;

                document.querySelectorAll('.status-select').forEach(sel => {
                    sel.addEventListener('change', () => {
                        const item = maintenance.find(m => String(m.id) === sel.dataset.id);
                        if (item) item.status = sel.value;
                        renderMaintenance();
                        renderStats();
                        toast(`Marked as "${statusLabel[sel.value]}" ✓`);
                    });
                });

                const open = maintenance.filter(m => m.status !== 'done').slice(0, 3);
                document.getElementById('overviewMaint').innerHTML = open.length ? open.map(m => `
                    <div class="receipt">
                        <div class="receipt-meta">
                            <div class="who">Unit ${m.unit} · ${m.reportedBy==='landlord' ? 'Reported by you' : 'Reported by tenant'}</div>
                            <div class="what">${m.desc} · ${statusLabel[m.status]}</div>
                        </div>
                        <span class="pri pri-${m.priority}">${m.priority==='high'?'Very urgent':m.priority==='med'?'Somewhat urgent':'Not urgent'}</span>
                    </div>`).join('') :
                    `<div class="empty-state"><div class="em-title">All caught up</div>No repairs waiting on you.</div>`;

                document.getElementById('maintBadge').textContent = maintenance.filter(m => m.status !== 'done').length;
            }

            document.getElementById('newRequestBtn').addEventListener('click', () => {
                populateTenantSelects();
                openModal('maintModal');
            });

            document.getElementById('mmSave').addEventListener('click', () => {
                const unit = document.getElementById('mmUnit').value;
                const desc = document.getElementById('mmDesc').value.trim();
                const priority = document.getElementById('mmPriority').value;
                if (!desc) {
                    toast('Please describe the problem first.');
                    return;
                }
                maintenance.push({
                    id: Date.now(),
                    unit,
                    desc,
                    priority,
                    status: 'new',
                    reportedBy: 'landlord'
                });
                document.getElementById('mmDesc').value = '';
                closeModal('maintModal');
                renderMaintenance();
                renderStats();
                toast('Added — labeled "Reported by you" ✓');
            });

            // ---------------- Notices ----------------
            function renderNotices() {
                document.getElementById('noticesList').innerHTML = notices.length ? notices.map(n => `
                    <div class="receipt">
                        <div class="receipt-meta">
                            <div class="who">${n.subject}</div>
                            <div class="what">To ${n.to} · ${n.date}</div>
                        </div>
                    </div>`).join('') :
                    `<div class="empty-state"><div class="em-title">No messages yet</div>Write one when a reminder is due.</div>`;
            }

            document.getElementById('newNoticeBtn').addEventListener('click', () => {
                populateTenantSelects();
                openModal('noticeModal');
            });
            document.getElementById('qaNewNotice').addEventListener('click', () => {
                populateTenantSelects();
                openModal('noticeModal');
            });

            document.getElementById('ntSave').addEventListener('click', () => {
                const unitId = document.getElementById('ntTenant').value;
                const subject = document.getElementById('ntSubject').value.trim();
                const u = units.find(x => x.id === unitId);
                if (!subject) {
                    toast('Please add a subject line.');
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
                toast('Message saved and sent ✓');
            });

            // ---------------- Shared helpers ----------------
            function populateTenantSelects() {
                const occupied = units.filter(u => u.status !== 'vacant');
                const opts = occupied.map(u => `<option value="${u.id}">${u.id} — ${u.tenant}</option>`).join('');
                document.getElementById('pmTenant').innerHTML = opts;
                document.getElementById('ntTenant').innerHTML = opts;
                document.getElementById('mmUnit').innerHTML = units.map(u =>
                    `<option value="${u.id}">${u.id}${u.tenant?' — '+u.tenant:' — vacant'}</option>`).join('');
            }

            // Sidebar registered-property toggle
            (function setupSidebarRegToggle() {
                const toggleBtn = document.getElementById('sidebarRegToggle');
                const body = document.getElementById('sidebarRegBody');
                const icon = document.getElementById('sidebarRegToggleIcon');
                if (!toggleBtn || !body) return;

                const STORAGE_KEY = 'sidebarRegPanelCollapsed';

                function setCollapsed(collapsed) {
                    body.style.display = collapsed ? 'none' : '';
                    if (icon) icon.style.transform = collapsed ? 'rotate(-90deg)' : 'rotate(0deg)';
                    toggleBtn.setAttribute('aria-expanded', String(!collapsed));
                    toggleBtn.title = collapsed ? 'Expand' : 'Minimize';
                    try {
                        localStorage.setItem(STORAGE_KEY, collapsed ? '1' : '0');
                    } catch (e) {}
                }

                let startCollapsed = false;
                try {
                    startCollapsed = localStorage.getItem(STORAGE_KEY) === '1';
                } catch (e) {}
                setCollapsed(startCollapsed);

                toggleBtn.addEventListener('click', () => {
                    const isCollapsed = body.style.display === 'none';
                    setCollapsed(!isCollapsed);
                });
            })();

            // Registered-property panel toggle
            (function setupRegPanelToggle() {
                const toggleBtn = document.getElementById('regPanelToggle');
                const body = document.getElementById('regPanelBody');
                const icon = document.getElementById('regPanelToggleIcon');
                const label = document.getElementById('regPanelToggleLabel');
                if (!toggleBtn || !body) return;

                const STORAGE_KEY = 'regPanelCollapsed';

                function setCollapsed(collapsed) {
                    body.style.display = collapsed ? 'none' : '';
                    if (icon) icon.style.transform = collapsed ? 'rotate(-90deg)' : 'rotate(0deg)';
                    if (label) label.textContent = collapsed ? 'Expand' : 'Minimize';
                    toggleBtn.setAttribute('aria-expanded', String(!collapsed));
                    try {
                        localStorage.setItem(STORAGE_KEY, collapsed ? '1' : '0');
                    } catch (e) {}
                }

                let startCollapsed = false;
                try {
                    startCollapsed = localStorage.getItem(STORAGE_KEY) === '1';
                } catch (e) {}
                setCollapsed(startCollapsed);

                toggleBtn.addEventListener('click', () => {
                    const isCollapsed = body.style.display === 'none';
                    setCollapsed(!isCollapsed);
                });
            })();

            // House rules toggle
            (function setupHouseRulesToggle() {
                const toggleBtn = document.getElementById('houseRulesToggle');
                const text = document.getElementById('houseRulesText');
                if (!toggleBtn || !text) return;

                let expanded = false;

                function refreshVisibility() {
                    const panelBody = document.getElementById('regPanelBody');
                    const panelHidden = panelBody && panelBody.style.display === 'none';
                    if (panelHidden || expanded) return;
                    toggleBtn.style.display = (text.scrollHeight > text.clientHeight + 2) ? '' : 'none';
                }

                toggleBtn.addEventListener('click', () => {
                    expanded = !expanded;
                    text.style.maxHeight = expanded ? text.scrollHeight + 'px' : '4.2em';
                    toggleBtn.textContent = expanded ? 'Show less' : 'Show more';
                });

                setTimeout(refreshVisibility, 0);
                const outerToggle = document.getElementById('regPanelToggle');
                if (outerToggle) outerToggle.addEventListener('click', () => setTimeout(refreshVisibility, 0));
            })();

            // ---------------- Init ----------------
            renderStats();
            renderProperties();
            renderTenants();
            renderLedger();
            renderMaintenance();
            renderNotices();

        })();
    </script>
</body>

</html>
