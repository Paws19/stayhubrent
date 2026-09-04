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

    {{--
        The rules below are scoped to Browse Rooms (plus the small bits it shares,
        like .btn-ghost.sm and .empty-maintenance on small screens). They're added
        here rather than edited into tenant.css directly since that file's current
        contents weren't available — feel free to move this block into tenant.css
        and delete it from here once you do.
    --}}

</head>

<body>

    @php
        // Unread count for the bell icon + sidebar badge. If your notifications
        // use a different "read" flag name, adjust `is_read` below.
        $unreadNotifications = ($notifications ?? collect())->where('is_read', false)->count();

        // Reservation requests the tenant has sent from Browse Rooms. Pass a
        // $reservations collection from the controller (each with room_name,
        // move_in_date, occupants, message, status, created_at) once it's
// wired up — this defaults to empty so a new account just sees the
// "No reservations yet" empty state.
$pendingReservationsCount = ($reservations ?? collect())->where('status', 'pending')->count();

// ── SAMPLE/DUMMY DATA FOR BROWSE ──
// While you don't have real $availableApartments yet, this renders
        // a handful of placeholder listings so the page has something to
        // look at and click through. As soon as the controller passes a
        // non-empty $availableApartments collection, this block is skipped
        // entirely and your real data takes over automatically.
        //
        // DELETE this whole sample-data setup block above (and the "Sample listings"
        // banner in the Browse Rooms section below) once real data is wired up.
        $isSampleApartments = ($availableApartments ?? collect())->isEmpty();

        if ($isSampleApartments) {
            $availableApartments = collect([
                (object) [
                    'id' => 'sample-1',
                    'room_name' => 'Room 204 — Sunview Residences',
                    'property_name' => 'Sunview Residences',
                    'address' => '123 Kalayaan Ave, Mandaluyong City',
                    'city' => 'Mandaluyong City',
                    'landlord_name' => 'Maria Santos',
                    'monthly_rent' => 4500,
                    'available_beds' => 1,
                    'bed_capacity' => 2,
                    'amenities' => 'WiFi, Aircon, Shared Kitchen',
                    'latitude' => 14.5794,
                    'longitude' => 121.0359,
                    'photos' => [
                        'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=700&q=60',
                        'https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=700&q=60',
                        'https://images.unsplash.com/photo-1560185127-6ed189bf02f4?auto=format&fit=crop&w=700&q=60',
                    ],
                ],
                (object) [
                    'id' => 'sample-2',
                    'room_name' => 'Room 12 — The Hub Dormitel',
                    'property_name' => 'The Hub Dormitel',
                    'address' => '45 Boni Ave, Mandaluyong City',
                    'city' => 'Mandaluyong City',
                    'landlord_name' => 'Carlo Reyes',
                    'monthly_rent' => 2800,
                    'available_beds' => 3,
                    'bed_capacity' => 4,
                    'amenities' => 'WiFi, CR, Laundry Area',
                    'latitude' => 14.5764,
                    'longitude' => 121.041,
                    'photos' => [
                        'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=700&q=60',
                        'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=700&q=60',
                        'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=700&q=60',
                    ],
                ],
                (object) [
                    'id' => 'sample-3',
                    'room_name' => 'Studio A — Greenview Suites',
                    'property_name' => 'Greenview Suites',
                    'address' => '78 Shaw Blvd, Mandaluyong City',
                    'city' => 'Mandaluyong City',
                    'landlord_name' => 'Ana Dela Cruz',
                    'monthly_rent' => 6200,
                    'available_beds' => 1,
                    'bed_capacity' => 1,
                    'amenities' => 'WiFi, Aircon, Private CR, Kitchenette',
                    'latitude' => 14.5822,
                    'longitude' => 121.0453,
                    'photos' => [
                        'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=700&q=60',
                        'https://images.unsplash.com/photo-1560185008-a33f5c1a0edc?auto=format&fit=crop&w=700&q=60',
                        'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=700&q=60',
                    ],
                ],
                (object) [
                    'id' => 'sample-4',
                    'room_name' => 'Room 7 — Casa Rosario',
                    'property_name' => 'Casa Rosario',
                    'address' => '9 Pioneer St, Mandaluyong City',
                    'city' => 'Mandaluyong City',
                    'landlord_name' => 'Jun Villanueva',
                    'monthly_rent' => 3200,
                    'available_beds' => 2,
                    'bed_capacity' => 3,
                    'amenities' => 'WiFi, Fan, Shared Kitchen',
                    'latitude' => 14.5763,
                    'longitude' => 121.0498,
                    'photos' => [
                        'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=700&q=60',
                        'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=700&q=60',
                        'https://images.unsplash.com/photo-1505873242700-f289a29e1e0f?auto=format&fit=crop&w=700&q=60',
                    ],
                ],
            ]);
        }
    @endphp

    <!-- TOP BAR -->
    <div class="topbar">
        <button class="menu-btn" id="menuBtn" aria-label="Toggle menu">☰</button>
        <a href="#" class="nav-logo"><span class="logo-dot"></span>StayHubRent</a>
        <div class="topbar-spacer"></div>
        <button class="icon-btn" id="bellBtn" aria-label="Notifications">
            @if ($unreadNotifications > 0)
                <span class="dot"></span>
            @endif
            🔔
        </button>
        <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
            <span class="theme-icon" id="themeIcon">🌙</span>
        </button>
        <button class="user-chip" id="userChip">
            <div class="user-avatar">{{ strtoupper(substr($GetFirstName->first_name ?? 'U', 0, 1)) }}</div>
            <span>{{ $GetFirstName->first_name ?? 'User' }}</span>
        </button>
    </div>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="shell">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <p class="side-label">Overview</p>
            <button class="side-link active" data-page="dashboard"><span class="si">🏠</span>Dashboard</button>
            <button class="side-link" data-page="browse"><span class="si">🔍</span>Browse Rooms</button>
            <button class="side-link" data-page="reservations"><span class="si">📄</span>My Reservations
                <span class="badge-count" id="reservationBadge"
                    @if ($pendingReservationsCount === 0) hidden @endif>{{ $pendingReservationsCount }}</span></button>
            @if ($hasRoom)
                <p class="side-label">My Stay</p>
                <button class="side-link" data-page="payments"><span class="si">💳</span>Payments</button>
                <button class="side-link" data-page="maintenance"><span class="si">🔧</span>Maintenance
                    <span class="badge-count"
                        @if (($pendingRequests->count() ?? 0) === 0) hidden @endif>{{ $pendingRequests->count() ?? 0 }}</span></button>
            @endif
            <button class="side-link" data-page="notifications"><span class="si">🔔</span>Notifications
                <span class="badge-count"
                    @if ($unreadNotifications === 0) hidden @endif>{{ $unreadNotifications }}</span></button>
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
                        <h1 id="greeting">Welcome back, {{ $GetFirstName->first_name ?? 'there' }} 👋</h1>
                        <p>Here's what's happening with your room and payments.</p>
                    </div>
                    @if ($hasRoom)
                        <button class="btn-primary" data-open-modal="requestModal">+ New Maintenance Request</button>
                    @else
                        <button class="btn-primary" data-page-link="browse">Browse Available Rooms</button>
                    @endif
                </div>

                <div class="stat-row">
                    <div class="stat-card">
                        <div class="label">Current Room</div>
                        @if ($hasRoom)
                            <div class="val">{{ $currentAssignment->apartment->room_number ?? '—' }}</div>
                        @else
                            <div class="val" style="opacity:.5">—</div>
                        @endif
                    </div>
                    <div class="stat-card">
                        <div class="label">Rent Due</div>
                        @if ($hasRoom && ($currentPayment ?? null))
                            <div class="val" style="color:var(--accent3)">
                                ₱{{ number_format($currentPayment->amount, 2) }}
                                <small>{{ \Carbon\Carbon::parse($currentPayment->due_date)->format('M d') }}</small>
                            </div>
                        @else
                            <div class="val" style="opacity:.5">—</div>
                        @endif
                    </div>
                    <div class="stat-card">
                        <div class="label">Lease Status</div>
                        @if ($hasRoom)
                            <div class="val" style="color:var(--accent2)">{{ ucfirst($currentAssignment->status) }}
                            </div>
                        @else
                            <div class="val" style="opacity:.5">No Lease</div>
                        @endif
                    </div>
                    <div class="stat-card">
                        <div class="label">Open Requests</div>
                        <div class="val">{{ $pendingRequests->count() ?? 0 }} <small>ongoing</small></div>
                    </div>
                </div>

                <div class="grid-2">
                    <div>
                        <!-- MY ROOM -->
                        <div class="card">
                            <div class="card-head">
                                <h3>My Room</h3>
                                @if ($hasRoom)
                                    <a href="#" data-toast="Dummy action: opens your lease PDF.">View Lease</a>
                                @endif
                            </div>

                            @if ($hasRoom ?? false)
                                <div class="room-hero">
                                    <div class="room-thumb">🛏️</div>
                                    <div class="room-info">
                                        <h4>{{ $currentAssignment->apartment->property_name ?? 'Your Property' }} ·
                                            Room {{ $currentAssignment->apartment->room_number ?? '—' }}</h4>
                                        <p>{{ $currentAssignment->apartment->address ?? '' }}</p>
                                        <p>Landlord: {{ $currentAssignment->apartment->landlord_name ?? '—' }}</p>
                                        <span class="badge badge-green">Lease
                                            {{ ucfirst($currentAssignment->status) }}</span>
                                        @if ($currentAssignment->move_out_date)
                                            <p style="font-size:.8rem;opacity:.65;margin-top:.5rem;">Move-out scheduled
                                                for
                                                {{ \Carbon\Carbon::parse($currentAssignment->move_out_date)->format('M d, Y') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="detail-list">
                                    <div class="detail-row"><span>Move-in
                                            date</span><span>{{ $currentAssignment->move_in_date ? \Carbon\Carbon::parse($currentAssignment->move_in_date)->format('M d, Y') : '—' }}</span>
                                    </div>
                                    <div class="detail-row"><span>Monthly
                                            rent</span><span>₱{{ number_format($currentAssignment->apartment->monthly_rent ?? 0, 2) }}</span>
                                    </div>
                                    <div class="detail-row"><span>Bed
                                            capacity</span><span>{{ $currentAssignment->apartment->occupied_beds ?? '?' }}
                                            of {{ $currentAssignment->apartment->bed_capacity ?? '?' }} occupied</span>
                                    </div>
                                    <div class="detail-row">
                                        <span>Amenities</span><span>{{ $currentAssignment->apartment->amenities ?? '—' }}</span>
                                    </div>
                                </div>

                                <!-- ROOM LOCATION MAP (Leaflet + OpenStreetMap — no API key needed) -->
                                <div class="room-map" id="roomMap"
                                    data-lat="{{ $currentAssignment->apartment->latitude ?? '' }}"
                                    data-lng="{{ $currentAssignment->apartment->longitude ?? '' }}"
                                    data-popup="{{ ($currentAssignment->apartment->property_name ?? 'Your Room') . ' · Room ' . ($currentAssignment->apartment->room_number ?? '') }}">
                                </div>
                                @if ($currentAssignment->apartment->latitude ?? null)
                                    <a href="https://www.openstreetmap.org/?mlat={{ $currentAssignment->apartment->latitude }}&mlon={{ $currentAssignment->apartment->longitude }}#map=17/{{ $currentAssignment->apartment->latitude }}/{{ $currentAssignment->apartment->longitude }}"
                                        target="_blank" rel="noopener" class="map-link">Get directions ↗</a>
                                @endif
                            @else
                                <div class="empty-maintenance">
                                    <div class="empty-icon">🏠</div>
                                    <h5>No room assigned yet</h5>
                                    <p>Once your landlord assigns you to a room, it'll show up here with all the details
                                        — address, rent, amenities, and a map.</p>
                                    <button class="btn-primary empty-state-cta" data-page-link="browse">Browse
                                        Available Rooms</button>
                                </div>
                            @endif
                        </div>

                        <!-- RECENT ACTIVITY -->
                        <div class="card">
                            <div class="card-head">
                                <h3>Recent Activity</h3>
                                <button class="link-btn" data-page-link="notifications">See all</button>
                            </div>
                            @forelse (($notifications ?? collect())->take(2) as $notification)
                                <div class="notif-item">
                                    <div class="notif-dot"></div>
                                    <div class="notif-info">
                                        <p>{{ $notification->message }}</p>
                                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-maintenance">
                                    <div class="empty-icon">🔔</div>
                                    <h5>Nothing here yet</h5>
                                    <p>Rent reminders and maintenance updates will show up here once you're settled in.
                                    </p>
                                </div>
                            @endforelse
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
                                <div class="check-item {{ $hasRoom ? 'done' : '' }}"><span
                                        class="tick">{{ $hasRoom ? '✓' : '' }}</span><span class="txt">Get
                                        assigned a room</span></div>
                                <div class="check-item" data-page-link="profile"><span class="tick"></span><span
                                        class="txt">Add a profile photo</span></div>
                                @if ($hasRoom)
                                    <div class="check-item" data-page-link="payments"><span
                                            class="tick"></span><span class="txt">Set up your first
                                            payment</span></div>
                                @endif
                            </div>
                        </div>

                        <!-- QUICK PAYMENT -->
                        <div class="card">
                            <div class="card-head">
                                <h3>Payment</h3>
                                @if ($hasRoom)
                                    <button class="link-btn" data-page-link="payments">Full history</button>
                                @endif
                            </div>
                            @if ($hasRoom && ($currentPayment ?? null))
                                <div class="due-box">
                                    <div>
                                        <div class="amt">₱{{ number_format($currentPayment->amount, 2) }}</div>
                                        <div class="sub">Due
                                            {{ \Carbon\Carbon::parse($currentPayment->due_date)->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <span class="badge badge-yellow">{{ ucfirst($currentPayment->status) }}</span>
                                </div>
                                <button class="btn-ghost" style="width:100%" data-page-link="payments">Upload receipt
                                    →</button>
                            @else
                                <div class="empty-maintenance">
                                    <div class="empty-icon">💳</div>
                                    <h5>No payments yet</h5>
                                    <p>{{ $hasRoom ? "Your landlord hasn't assigned a payment yet." : "You'll see your rent due here once you have a room." }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <!-- PAGE: BROWSE ROOMS -->
            <section class="page" id="page-browse">
                <div class="page-head">
                    <div>
                        <h1>Browse Rooms 🏡</h1>
                        <p>Looking for a new place, or want to refer a friend? Take a look at what's open right now —
                            we're happy to help you find a good fit.</p>
                    </div>
                </div>

                <div class="browse-intro">
                    <span class="bi-emoji">😊</span>
                    <span>Every room here is ready to welcome someone new. Tap a card for the full details, or just say
                        hi to the landlord with a reservation request!</span>
                </div>

                @if ($isSampleApartments)
                    <div class="sample-banner">
                        <span class="sb-icon">🧪</span>
                        <span>These are sample listings for preview only — connect
                            <code>$availableApartments</code> in the controller to show real data.</span>
                    </div>
                @endif

                <div class="search-row">
                    <div class="search-box">
                        <span class="search-icon">🔎</span>
                        <input type="text" placeholder="Search by location or property name…" id="browseSearch" />
                    </div>
                    <div class="filter-chips">
                        <button class="filter-chip active" data-filter="all">All rooms</button>
                        <button class="filter-chip" data-filter="under3000">Under ₱3,000</button>
                        <button class="filter-chip" data-filter="hasbed">Beds available</button>
                        <button class="filter-chip" data-filter="nearme">Near me</button>
                    </div>
                </div>

                <div class="browse-grid" id="browseGrid">
                    @forelse ($availableApartments as $apartment)
                        <div class="browse-card" data-room-id="{{ $apartment->id }}"
                            data-name="{{ $apartment->room_name ?? 'Room ' . $apartment->id }}"
                            data-property="{{ $apartment->property_name ?? '' }}"
                            data-address="{{ $apartment->address ?? '' }}"
                            data-landlord="Landlord: {{ $apartment->landlord_name ?? '—' }}"
                            data-price="₱{{ number_format($apartment->monthly_rent ?? 0, 0) }}/mo"
                            data-price-raw="{{ $apartment->monthly_rent ?? 0 }}"
                            data-beds-open="{{ $apartment->available_beds ?? 0 }}"
                            data-availability="{{ $apartment->available_beds ?? '?' }} of {{ $apartment->bed_capacity ?? '?' }} beds open"
                            data-amenities="{{ $apartment->amenities ?? '—' }}"
                            data-lat="{{ $apartment->latitude ?? '' }}" data-lng="{{ $apartment->longitude ?? '' }}"
                            data-location="{{ $apartment->city ?? ($apartment->address ?? '') }}"
                            data-photos="{{ json_encode($apartment->photos ?? []) }}">
                            <div class="browse-thumb">
                                @if (!empty($apartment->photos[0]))
                                    <img src="{{ $apartment->photos[0] }}"
                                        alt="Photo of {{ $apartment->room_name ?? 'the room' }}" loading="lazy" />
                                @else
                                    <span class="no-photo-emoji">🏠</span>
                                @endif
                                @if (($apartment->available_beds ?? 0) > 0)
                                    <span class="thumb-tag">😊 {{ $apartment->available_beds }}
                                        bed{{ $apartment->available_beds > 1 ? 's' : '' }} open</span>
                                @else
                                    <span class="thumb-tag full">Full for now</span>
                                @endif
                            </div>
                            <div class="browse-body">
                                <h5>{{ $apartment->room_name ?? 'Room ' . $apartment->id }}</h5>
                                <div class="loc">📍 {{ $apartment->city ?? ($apartment->address ?? '') }}</div>
                                <div class="amenity-tags">
                                    @foreach (array_slice(array_filter(array_map('trim', explode(',', $apartment->amenities ?? ''))), 0, 3) as $tag)
                                        <span class="tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                                <div class="browse-foot">
                                    <div class="price">
                                        ₱{{ number_format($apartment->monthly_rent ?? 0, 0) }}<span>/mo</span></div>
                                    <button type="button" class="btn-ghost sm">Say hi 👋</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-maintenance" style="grid-column: 1 / -1;">
                            <div class="empty-icon">🔍</div>
                            <h5>No rooms available right now</h5>
                            <p>Check back soon — new listings are added regularly.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- PAGE: MY RESERVATIONS — reservation requests the tenant has sent
                 from Browse Rooms, with their current status. -->
            <section class="page" id="page-reservations">
                <div class="page-head">
                    <div>
                        <h1>My Reservations</h1>
                        <p>Track the rooms you've asked to reserve and their status.</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <h3>Requests</h3>
                    </div>
                    <p class="section-desc">A room stays "Pending" until the landlord accepts or declines it.</p>
                    <div id="reservationsList">
                        @forelse ($reservations ?? [] as $reservation)
                            <div class="maint-item">
                                <div class="maint-icon">📄</div>
                                <div class="maint-info">
                                    <h5>{{ $reservation->room_name ?? 'Room' }}</h5>
                                    <p>
                                        Requested
                                        {{ isset($reservation->created_at) ? $reservation->created_at->format('M j, Y') : '' }}
                                        @if (!empty($reservation->move_in_date))
                                            · Move-in
                                            {{ \Carbon\Carbon::parse($reservation->move_in_date)->format('M j, Y') }}
                                        @endif
                                        @if (!empty($reservation->occupants))
                                            · {{ $reservation->occupants }}
                                            occupant{{ $reservation->occupants > 1 ? 's' : '' }}
                                        @endif
                                    </p>
                                </div>
                                <span
                                    class="badge badge-{{ ($reservation->status ?? 'pending') === 'approved' ? 'green' : (($reservation->status ?? 'pending') === 'declined' ? 'red' : 'yellow') }}">
                                    {{ ucfirst($reservation->status ?? 'Pending') }}
                                </span>
                            </div>
                        @empty
                            <div class="empty-maintenance" id="reservationsEmpty">
                                <div class="empty-icon">📄</div>
                                <h5>No reservations yet</h5>
                                <p>Once you send a reservation request from Browse Rooms, it'll show up here as
                                    "Pending" until the landlord responds.</p>
                                <button class="btn-primary empty-state-cta" data-page-link="browse">Browse
                                    Available Rooms</button>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <!-- PAGE: PAYMENTS — only rendered at all once the tenant has a room, so a
                 new account never even has this in the DOM (not just hidden in the nav). -->
            @if ($hasRoom)
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
                                            <th>Transaction ID</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody id="paymentHistoryBody">
                                        @forelse ($paymentHistory as $payment)
                                            <tr data-month="{{ $payment->month }}">

                                                {{-- Month --}}
                                                <td>{{ $payment->month }}</td>

                                                {{-- Amount --}}
                                                <td>₱{{ number_format($payment->amount, 2) }}</td>

                                                {{-- Date Paid --}}
                                                <td>
                                                    {{ $payment->date_paid ?? $payment->created_at->format('M d, Y') }}
                                                </td>

                                                {{-- Transaction ID --}}
                                                <td>{{ $payment->transaction_id }}</td>

                                                {{-- Payment Method --}}
                                                <td>{{ $payment->payment_method }}</td>

                                                {{-- Status --}}
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $payment->status === 'paid' ? 'green' : 'red' }}">
                                                        {{ ucfirst($payment->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6"
                                                    style="text-align:center; white-space:normal; opacity:.6;">No
                                                    payments recorded yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div>
                            <div class="card">
                                <div class="card-head">
                                    <h3>This Month</h3>
                                </div>

                                @if ($currentPayment ?? $paymentHistory->first())
                                    {{-- Payment has been assigned by the landlord --}}
                                    <div class="due-box">
                                        <div>
                                            <div class="amt">
                                                ₱{{ number_format($currentPayment->amount, 2) }}
                                            </div>

                                            <div class="sub">
                                                Due
                                                {{ \Carbon\Carbon::parse($currentPayment->due_date)->format('M d, Y') }}
                                            </div>
                                        </div>

                                        <span class="badge badge-yellow">
                                            {{ ucfirst($currentPayment->status) }}
                                        </span>
                                    </div>

                                    <!-- DRAG & DROP RECEIPT UPLOAD -->
                                    <div class="dropzone" id="receiptDropzone">
                                        <span class="ic">📤</span>
                                        Drag your GCash receipt here, or click to browse

                                        <input type="file" id="receiptInput" accept="image/*,.pdf" />
                                    </div>

                                    <div class="file-chip" id="receiptChip">
                                        <span class="fx" id="receiptFileName"></span>

                                        <button type="button" id="receiptRemove" aria-label="Remove file">
                                            ✕
                                        </button>
                                    </div>

                                    <button type="button" class="btn-primary" style="width:100%; margin-top:0.9rem;"
                                        id="confirmPaymentBtn">
                                        Confirm Payment
                                    </button>
                                @else
                                    {{-- No payment has been assigned yet --}}
                                    <div class="due-box">
                                        <div>
                                            <div class="amt">No Payment Assigned</div>

                                            <div class="sub">
                                                Your landlord has not assigned a rental payment yet.
                                            </div>
                                        </div>

                                        <span class="badge badge-yellow">
                                            Not Assigned
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            <!-- PAGE: MAINTENANCE — only rendered at all once the tenant has a room. -->
            @if ($hasRoom)
                <section class="page" id="page-maintenance">
                    <div class="page-head">
                        <div>
                            <h1>Maintenance</h1>
                            <p>Report an issue in your room or shared spaces.</p>
                        </div>
                        <button class="btn-primary" data-open-modal="requestModal"> + New Request </button>
                    </div>

                    <!-- ONGOING -->
                    <div class="card">
                        <div class="card-head">
                            <h3>Ongoing</h3>
                        </div>
                        <p class="section-desc">Reports currently pending or assigned to the maintenance team. Tap
                            a report to see its full details.</p>
                        @if ($pendingRequests->count() > 0)
                            @foreach ($pendingRequests as $request)
                                <div class="maint-item" data-open-modal="maintenanceDetailsModal"
                                    data-maint-title="{{ ucfirst($request->request_title) }}"
                                    data-maint-description="{{ $request->request_description ?? 'No description provided.' }}"
                                    data-maint-status="{{ ucfirst($request->request_status) }}"
                                    data-maint-status-class="badge-yellow"
                                    data-maint-filed="Filed {{ $request->created_at->format('M j, Y') }}"
                                    data-maint-note="Assigned to maintenance team"
                                    data-maint-image="{{ $request->request_image ? asset('storage/' . $request->request_image) : '' }}">
                                    <div class="maint-icon">🔧</div>
                                    <div class="maint-info">
                                        <h5> {{ ucfirst($request->request_title) }} </h5>
                                        <p> Filed {{ $request->created_at->format('M j, Y') }} · Assigned to
                                            maintenance
                                            team </p>
                                    </div> <span class="badge badge-yellow"> {{ ucfirst($request->request_status) }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-maintenance">
                                <div class="empty-icon">🔧</div>
                                <h5>No maintenance requests</h5>
                                <p> You don't have any pending maintenance requests. </p>
                            </div>
                        @endif
                    </div> <!-- RESOLVED -->
                    <div class="card">
                        <div class="card-head">
                            <h3>Resolved</h3>
                        </div>
                        <p class="section-desc">Reports the maintenance team has already fixed. Tap a report to
                            review what was filed.</p>
                        @if ($resolvedRequests->count() > 0)
                            @foreach ($resolvedRequests as $request)
                                <div class="maint-item" data-open-modal="maintenanceDetailsModal"
                                    data-maint-title="{{ ucfirst($request->request_title) }}"
                                    data-maint-description="{{ $request->request_description ?? 'No description provided.' }}"
                                    data-maint-status="Resolved" data-maint-status-class="badge-green"
                                    data-maint-filed="Filed {{ $request->created_at->format('M j, Y') }}"
                                    data-maint-note="{{ $request->updated_at ? 'Resolved ' . $request->updated_at->format('M j, Y') : 'Resolved' }}"
                                    data-maint-image="{{ $request->request_image ? asset('storage/' . $request->request_image) : '' }}">
                                    <div class="maint-icon">💡</div>
                                    <div class="maint-info">
                                        <h5> {{ ucfirst($request->request_title) }} </h5>
                                        <p> Filed {{ $request->created_at->format('M j, Y') }} · Resolved </p>
                                    </div> <span class="badge badge-green"> Resolved </span>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-maintenance">
                                <div class="empty-icon"></div>
                                <h5>No resolved requests</h5>
                                <p> You don't have any resolved maintenance requests yet. </p>
                            </div>
                        @endif
                    </div>
                </section>
            @endif

            <!-- PAGE: NOTIFICATIONS -->
            <section class="page" id="page-notifications">
                <div class="page-head">
                    <div>
                        <h1>Notifications</h1>
                        <p>Stay on top of rent reminders and updates.</p>
                    </div>
                    @if (($notifications ?? collect())->count() > 0)
                        <button class="btn-ghost" id="markAllReadBtn">Mark all read</button>
                    @endif
                </div>

                <div class="card">
                    @forelse ($notifications ?? [] as $notification)
                        <div class="notif-item {{ $notification->is_read ? 'read' : '' }}" data-mark-read>
                            <div class="notif-dot"></div>
                            <div class="notif-info">
                                <p>{{ $notification->message }}</p>
                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @empty
                        <div class="empty-maintenance">
                            <div class="empty-icon">🔔</div>
                            <h5>No notifications yet</h5>
                            <p>You're all caught up. We'll let you know when there's something new.</p>
                        </div>
                    @endforelse
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
                        <div class="profile-avatar">{{ strtoupper(substr($GetFirstName->first_name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <button class="btn-ghost"
                                data-toast="Dummy action: opens a file picker for your profile photo.">Change
                                photo</button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full name</label>
                            <input type="text" value="{{ $GetFirstName->first_name ?? '' }}" />
                        </div>
                        <div class="form-group">
                            <label>Mobile number</label>
                            <input type="text" value="{{ Auth::user()->mobile_number ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" value="{{ Auth::user()->email ?? '' }}" />
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

            <!-- HEADER -->
            <div class="modal-head">
                <h3>New Maintenance Request</h3>

                <button type="button" class="modal-close" data-close-modal="requestModal">
                    ✕
                </button>
            </div>


            <!-- FORM -->
            <form id="requestForm" action="{{ route('request-maintenance.store') }}" method="POST"
                enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="account_id" value="{{ Auth::user()->id }}">

                <!-- REQUEST TYPE -->
                <div class="form-group">

                    <label for="request_title">
                        What needs attention?
                    </label>

                    <select name="request_title" id="request_title" required>

                        <option value="" selected disabled>
                            Select an issue
                        </option>

                        <option value="plumbing">
                            Plumbing
                        </option>

                        <option value="electrical">
                            Electrical
                        </option>

                        <option value="aircon">
                            Aircon
                        </option>

                        <option value="furniture">
                            Furniture
                        </option>

                        <option value="other">
                            Other
                        </option>

                    </select>

                </div>


                <!-- DESCRIPTION -->
                <div class="form-group">

                    <label for="request_description">
                        Describe the issue
                    </label>

                    <textarea name="request_description" id="request_description"
                        placeholder="e.g. The sink in the shared kitchen is clogged..." maxlength="1000" required></textarea>

                </div>


                <!-- IMAGE -->
                <div class="form-group">

                    <label>
                        Add a photo (optional)
                    </label>

                    <div class="dropzone" id="photoDropzone">

                        <span class="ic">📷</span>

                        <span>
                            Drag a photo here, or click to browse
                        </span>

                        <input type="file" id="photoInput" name="request_image"
                            accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml">

                    </div>


                    <!-- SELECTED FILE -->
                    <div class="file-chip" id="photoChip" style="display:none;">

                        <span class="fx" id="photoFileName"></span>

                        <button type="button" id="photoRemove" aria-label="Remove file">
                            ✕
                        </button>

                    </div>

                </div>


                <!-- FOOTER -->
                <div class="modal-footer">

                    <button type="button" class="btn-ghost" data-close-modal="requestModal">
                        Cancel
                    </button>

                    <button type="submit" class="btn-primary" id="submitRequestBtn">
                        Submit Request
                    </button>

                </div>

            </form>

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
                <div class="room-thumb" id="rdThumb">🏠</div>
                <div class="room-info">
                    <h4 id="rdProperty"></h4>
                    <p id="rdAddress"></p>
                    <p id="rdLandlord"></p>
                    <span class="badge badge-blue" id="rdPrice"></span>
                </div>
            </div>
            <div class="gallery-strip" id="rdGallery"></div>
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

    <!-- RESERVATION REQUEST FORM MODAL — opens from "Send Reservation Request"
         in the Room Details modal. A quick form (rather than a single instant
         click) so the landlord actually gets something to review. -->
    <div class="modal-overlay" id="reservationFormModal">
        <div class="modal-card">
            <div class="modal-head">
                <h3>Request to Reserve — <span id="rfRoomName">this room</span></h3>
                <button type="button" class="modal-close" data-close-modal="reservationFormModal">✕</button>
            </div>
            <form id="reservationForm">
                <div class="form-group">
                    <label for="rfMoveInDate">Preferred move-in date</label>
                    <input type="date" id="rfMoveInDate" required />
                </div>
                <div class="form-group">
                    <label for="rfOccupants">Number of occupants</label>
                    <input type="number" id="rfOccupants" min="1" value="1" required />
                </div>
                <div class="form-group">
                    <label for="rfMessage">Message to the landlord (optional)</label>
                    <textarea id="rfMessage" maxlength="500"
                        placeholder="e.g. Hi! I'm a working student looking to move in early next month..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-ghost" data-close-modal="reservationFormModal">Cancel</button>
                    <button type="submit" class="btn-primary" id="rfSubmitBtn">Send Request</button>
                </div>
            </form>
        </div>
    </div>

    <!-- RESERVATION SENT / THANK YOU MODAL — pops up right after a tenant
         submits the reservation form above. -->
    <div class="modal-overlay" id="reservationThanksModal">
        <div class="modal-card centered">
            <div class="thanks-icon">🎉</div>
            <h3>Thank you!</h3>
            <div class="thanks-body">
                <p>Your reservation request for <strong id="rtRoomName">this room</strong> has been sent.</p>
                <p>The landlord will review it and get back to you soon — we'll notify you here once there's an
                    update.</p>
            </div>
            <div class="modal-footer" style="justify-content:center;">
                <button type="button" class="btn-primary" data-close-modal="reservationThanksModal">Got it,
                    thanks!</button>
            </div>
        </div>
    </div>

    <!-- PHOTO LIGHTBOX MODAL — full-size, zoomable viewer for room photos.
         Opened from the main photo or gallery thumbnails in Room Details. -->
    <div class="modal-overlay" id="photoLightboxModal">
        <div class="modal-card lightbox">
            <div class="lightbox-topbar">
                <span class="lightbox-counter" id="lightboxCounter"></span>
                <button type="button" class="lightbox-close" data-close-modal="photoLightboxModal"
                    aria-label="Close">✕</button>
            </div>
            <div class="lightbox-stage">
                <button type="button" class="lightbox-nav" id="lightboxPrev" aria-label="Previous photo">‹</button>
                <img id="lightboxImg" src="" alt="Room photo" />
                <button type="button" class="lightbox-nav" id="lightboxNext" aria-label="Next photo">›</button>
            </div>
            <span class="lightbox-hint">Tap the photo to zoom in</span>
        </div>
    </div>

    <!-- MAINTENANCE REPORT DETAILS MODAL — opens from a clicked report in
         the Ongoing / Resolved lists on the Maintenance page. -->
    <div class="modal-overlay" id="maintenanceDetailsModal">
        <div class="modal-card">
            <div class="modal-head">
                <h3 id="mdTitle">Request</h3>
                <button class="modal-close" data-close-modal="maintenanceDetailsModal">✕</button>
            </div>
            <div class="detail-list" style="margin-bottom:1rem;">
                <div class="detail-row"><span>Status</span><span id="mdStatusWrap"><span class="badge"
                            id="mdStatus"></span></span></div>
                <div class="detail-row"><span>Filed</span><span id="mdFiled"></span></div>
                <div class="detail-row"><span>Update</span><span id="mdNote"></span></div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <p id="mdDescription" style="margin:0;line-height:1.5;"></p>
            </div>
            <div id="mdImageWrap" style="display:none;margin-top:1rem;">
                <label style="display:block;margin-bottom:.5rem;">Photo</label>
                <img id="mdImage" src="" alt="Maintenance report photo"
                    style="width:100%;border-radius:10px;display:block;" />
            </div>
            <div class="modal-footer">
                <button class="btn-ghost" data-close-modal="maintenanceDetailsModal">Close</button>
            </div>
        </div>
    </div>

    <div class="toast-wrap" id="toastWrap"></div>

    <!-- Leaflet + OpenStreetMap — free, no API key required -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
        let roomMap;
        const roomMapEl = document.getElementById('roomMap');
        if (roomMapEl) {
            const lat = parseFloat(roomMapEl.dataset.lat);
            const lng = parseFloat(roomMapEl.dataset.lng);
            if (!isNaN(lat) && !isNaN(lng)) {
                roomMap = L.map('roomMap', {
                    scrollWheelZoom: false
                }).setView([lat, lng], 16);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 19
                }).addTo(roomMap);
                L.marker([lat, lng]).addTo(roomMap)
                    .bindPopup(roomMapEl.dataset.popup || 'Your Room')
                    .openPopup();
            } else {
                roomMapEl.style.display = 'none';
            }
        }

        // ── PAGE NAVIGATION ──
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
            if (pageId === 'dashboard' && roomMap) setTimeout(() => roomMap.invalidateSize(), 200);
        }

        document.querySelectorAll('.side-link[data-page]').forEach(link => {
            link.addEventListener('click', () => goToPage(link.dataset.page));
        });

        document.querySelectorAll('[data-page-link]').forEach(el => {
            el.addEventListener('click', () => goToPage(el.dataset.pageLink));
        });

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
            btn.addEventListener('click', () => {
                if (btn.disabled) return;
                openModal(btn.dataset.openModal);
            });
        });
        document.querySelectorAll('[data-close-modal]').forEach(btn => {
            btn.addEventListener('click', () => closeModal(btn.dataset.closeModal));
        });
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) closeModal(overlay.id);
            });
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay.active').forEach(m => closeModal(m.id));
            }
        });

        // ── GENERIC DRAG & DROP HELPER ──
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

            if (!zone || !input || !chip || !nameEl || !removeBtn) return;

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

        const confirmPaymentBtn = document.getElementById('confirmPaymentBtn');
        if (confirmPaymentBtn) {
            confirmPaymentBtn.addEventListener('click', () => {
                showToast('Dummy action: this would submit your payment for review.');
            });
        }

        const submitRequestBtn = document.getElementById('submitRequestBtn');
        if (submitRequestBtn) {
            submitRequestBtn.addEventListener('click', () => {
                showToast('Dummy action: this would create the maintenance request.');
                closeModal('requestModal');
            });
        }

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

        document.querySelectorAll('#paymentHistoryBody tr').forEach(row => {
            if (!row.dataset.month) return;
            row.addEventListener('click', () => {
                showToast(`Dummy action: shows the receipt/details for ${row.dataset.month}.`);
            });
        });

        document.querySelectorAll('[data-mark-read]').forEach(item => {
            item.addEventListener('click', () => item.classList.add('read'));
        });
        const markAllReadBtn = document.getElementById('markAllReadBtn');
        if (markAllReadBtn) {
            markAllReadBtn.addEventListener('click', () => {
                document.querySelectorAll('[data-mark-read]').forEach(i => i.classList.add('read'));
                showToast('All notifications marked as read.');
            });
        }

        // ── BROWSE ROOMS ──
        let rdMap, rdMarker;
        let lbPhotos = [];
        let lbIndex = 0;

        function renderLightbox() {
            const img = document.getElementById('lightboxImg');
            img.src = lbPhotos[lbIndex] || '';
            img.classList.remove('zoomed');
            document.getElementById('lightboxCounter').textContent =
                lbPhotos.length ? `${lbIndex + 1} / ${lbPhotos.length}` : '';
            const showNav = lbPhotos.length > 1;
            document.getElementById('lightboxPrev').style.display = showNav ? '' : 'none';
            document.getElementById('lightboxNext').style.display = showNav ? '' : 'none';
        }

        function openLightbox(photos, startIndex) {
            if (!photos || !photos.length) return;
            lbPhotos = photos;
            lbIndex = startIndex || 0;
            renderLightbox();
            openModal('photoLightboxModal');
        }

        document.getElementById('lightboxPrev').addEventListener('click', () => {
            lbIndex = (lbIndex - 1 + lbPhotos.length) % lbPhotos.length;
            renderLightbox();
        });
        document.getElementById('lightboxNext').addEventListener('click', () => {
            lbIndex = (lbIndex + 1) % lbPhotos.length;
            renderLightbox();
        });
        document.getElementById('lightboxImg').addEventListener('click', (e) => {
            e.target.classList.toggle('zoomed');
        });

        function openRoomDetails(card) {
            const d = card.dataset;

            document.getElementById('rdName').textContent = d.name || 'Room';
            document.getElementById('rdProperty').textContent = d.property || '';
            document.getElementById('rdAddress').textContent = d.address || '';
            document.getElementById('rdLandlord').textContent = d.landlord || '';
            document.getElementById('rdPrice').textContent = d.price || '';

            let photos = [];
            try {
                photos = d.photos ? JSON.parse(d.photos) : [];
            } catch (err) {
                photos = [];
            }

            const rdThumb = document.getElementById('rdThumb');
            const rdGallery = document.getElementById('rdGallery');
            let rdActiveIndex = 0;

            function setMainPhoto(url, index) {
                rdActiveIndex = index ?? 0;
                if (url) {
                    rdThumb.innerHTML =
                        `<img src="${url}" alt="Photo of ${d.name || 'the room'}" /><span class="zoom-hint">🔍 Zoom</span>`;
                } else {
                    rdThumb.innerHTML = '🏠';
                }
                rdGallery.querySelectorAll('img').forEach((img, i) => {
                    img.classList.toggle('active', i === rdActiveIndex);
                });
            }

            rdThumb.onclick = () => {
                if (photos.length) openLightbox(photos, rdActiveIndex);
            };

            if (photos.length) {
                setMainPhoto(photos[0], 0);
                rdGallery.innerHTML = photos.map((url, i) =>
                    `<img src="${url}" alt="Photo ${i + 1} of ${d.name || 'the room'}" class="${i === 0 ? 'active' : ''}" />`
                ).join('');
                rdGallery.querySelectorAll('img').forEach((img, i) => {
                    img.addEventListener('click', () => setMainPhoto(photos[i], i));
                });
                rdGallery.style.display = photos.length > 1 ? '' : 'none';
            } else {
                setMainPhoto(null, 0);
                rdGallery.innerHTML = '';
                rdGallery.style.display = 'none';
            }

            document.getElementById('rdDetails').innerHTML = `
                <div class="detail-row"><span>Availability</span><span>${d.availability || '—'}</span></div>
                <div class="detail-row"><span>Amenities</span><span>${d.amenities || '—'}</span></div>
            `;
            document.getElementById('rdReserveBtn').dataset.roomName = d.name || 'this room';

            openModal('roomDetailsModal');

            const lat = parseFloat(d.lat);
            const lng = parseFloat(d.lng);
            const hasCoords = !isNaN(lat) && !isNaN(lng);
            const directionsLink = document.getElementById('rdDirectionsLink');
            const mapEl = document.getElementById('rdMap');

            if (!hasCoords) {
                directionsLink.style.display = 'none';
                mapEl.style.display = 'none';
                return;
            }

            directionsLink.style.display = '';
            mapEl.style.display = '';
            directionsLink.href =
                `https://www.openstreetmap.org/?mlat=${lat}&mlon=${lng}#map=17/${lat}/${lng}`;

            setTimeout(() => {
                if (!rdMap) {
                    rdMap = L.map('rdMap', {
                        scrollWheelZoom: false
                    }).setView([lat, lng], 16);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(rdMap);
                } else {
                    rdMap.invalidateSize();
                    rdMap.setView([lat, lng], 16);
                }
                if (rdMarker) rdMarker.remove();
                rdMarker = L.marker([lat, lng]).addTo(rdMap)
                    .bindPopup(d.property || d.name || '')
                    .openPopup();
            }, 80);
        }

        document.querySelectorAll('#browseGrid .browse-card').forEach(card => {
            card.addEventListener('click', () => openRoomDetails(card));
        });

        const rdReserveBtn = document.getElementById('rdReserveBtn');
        if (rdReserveBtn) {
            rdReserveBtn.addEventListener('click', () => {
                const roomName = rdReserveBtn.dataset.roomName || 'this room';
                closeModal('roomDetailsModal');
                document.getElementById('rfRoomName').textContent = roomName;
                document.getElementById('reservationForm').dataset.roomName = roomName;
                openModal('reservationFormModal');
            });
        }

        const reservationForm = document.getElementById('reservationForm');
        if (reservationForm) {
            reservationForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const roomName = reservationForm.dataset.roomName || 'this room';
                const moveInDate = document.getElementById('rfMoveInDate').value;
                const occupants = document.getElementById('rfOccupants').value;
                // Dummy action: this is where the move-in date, occupant count,
                // and message would be POSTed to the reservation-request route.
                addPendingReservation(roomName, moveInDate, occupants);
                closeModal('reservationFormModal');
                reservationForm.reset();
                document.getElementById('rtRoomName').textContent = roomName;
                openModal('reservationThanksModal');
            });
        }

        // ── MY RESERVATIONS — adds a "Pending" entry right after a tenant
        // submits the reservation form, and bumps the sidebar badge count.
        function addPendingReservation(roomName, moveInDate, occupants) {
            const list = document.getElementById('reservationsList');
            const emptyState = document.getElementById('reservationsEmpty');
            if (emptyState) emptyState.remove();

            const today = new Date().toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
            const moveInLabel = moveInDate ? new Date(moveInDate + 'T00:00:00').toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            }) : '';
            const occupantsLabel = occupants ? `${occupants} occupant${occupants > 1 ? 's' : ''}` : '';
            const metaParts = [`Requested ${today}`];
            if (moveInLabel) metaParts.push(`Move-in ${moveInLabel}`);
            if (occupantsLabel) metaParts.push(occupantsLabel);

            const item = document.createElement('div');
            item.className = 'maint-item';
            item.innerHTML = `
                <div class="maint-icon">📄</div>
                <div class="maint-info">
                    <h5></h5>
                    <p></p>
                </div>
                <span class="badge badge-yellow">Pending</span>
            `;
            item.querySelector('h5').textContent = roomName;
            item.querySelector('p').textContent = metaParts.join(' · ');
            list.prepend(item);

            const badge = document.getElementById('reservationBadge');
            const newCount = (parseInt(badge.textContent, 10) || 0) + 1;
            badge.textContent = newCount;
            badge.hidden = false;
        }

        const browseSearchInput = document.getElementById('browseSearch');
        let activeBrowseFilter = 'all';

        function getBrowseCards() {
            return Array.from(document.querySelectorAll('#browseGrid .browse-card'));
        }

        function applyBrowseFilters() {
            const query = (browseSearchInput?.value || '').trim().toLowerCase();
            getBrowseCards().forEach(card => {
                const d = card.dataset;
                const matchesQuery = !query ||
                    (d.name || '').toLowerCase().includes(query) ||
                    (d.location || '').toLowerCase().includes(query) ||
                    (d.property || '').toLowerCase().includes(query);
                const price = parseFloat(d.priceRaw || '0');
                const bedsOpen = parseInt(d.bedsOpen || '0', 10);
                const matchesPrice = activeBrowseFilter !== 'under3000' || price < 3000;
                const matchesBeds = activeBrowseFilter !== 'hasbed' || bedsOpen > 0;
                card.style.display = (matchesQuery && matchesPrice && matchesBeds) ? '' : 'none';
            });
        }

        if (browseSearchInput) {
            browseSearchInput.addEventListener('input', applyBrowseFilters);
        }

        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                const filter = chip.dataset.filter;
                if (filter === 'nearme') {
                    showToast(
                        'Dummy action: this would sort rooms by distance from your current location.');
                    return;
                }
                document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
                activeBrowseFilter = filter;
                applyBrowseFilters();
            });
        });

        document.getElementById('saveProfileBtn').addEventListener('click', () => {
            showToast('Dummy action: this would save your profile changes.');
        });

        document.querySelectorAll('.maint-item[data-open-modal]').forEach(item => {
            item.addEventListener('click', () => {
                document.getElementById('mdTitle').textContent = item.dataset.maintTitle || 'Request';
                document.getElementById('mdFiled').textContent = item.dataset.maintFiled || '';
                document.getElementById('mdNote').textContent = item.dataset.maintNote || '';
                document.getElementById('mdDescription').textContent = item.dataset.maintDescription || '';

                const statusEl = document.getElementById('mdStatus');
                statusEl.textContent = item.dataset.maintStatus || '';
                statusEl.className = 'badge ' + (item.dataset.maintStatusClass || 'badge-yellow');

                const imgWrap = document.getElementById('mdImageWrap');
                const imgEl = document.getElementById('mdImage');
                if (item.dataset.maintImage) {
                    imgEl.src = item.dataset.maintImage;
                    imgWrap.style.display = 'block';
                } else {
                    imgEl.src = '';
                    imgWrap.style.display = 'none';
                }

                openModal('maintenanceDetailsModal');
            });
        });
    </script>
</body>

</html>
