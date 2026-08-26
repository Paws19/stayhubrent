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
    <link rel="stylesheet" href="{{ asset('css/get-started.css') }}" />
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
                        <form method="POST" action="{{ route('role.store') }}">
                            @csrf

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

                            <button type="submit" class="btn-full" id="btnStep1" disabled>
                                Continue <span>→</span>
                            </button>
                        </form>



                        <p class="signin-link">Already have an account? <a href="#">Sign in</a></p>
                    </div>

                    <!-- ═══ STEP 2: ACCOUNT ═══ -->
                    <div class="step-slide" id="step2">
                        <div class="form-head">
                            <h1 id="s2title">Create account</h1>
                            <p id="s2sub">Set up your login credentials</p>
                        </div>

                        <!---- Success or error message --->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="field-group">
                            <form method="POST" action="{{ route('register.store') }}">
                                @csrf

                                <input type="hidden" name="role" id="roleInput"
                                    value="{{ session('selected_role') }}">
                                <div class="field-row">
                                    <div class="field">
                                        <label>First Name <span>*</span></label>
                                        <input type="text" placeholder="Juan" name="first_name"
                                            value="{{ old('first_name') }}" id="firstName" />
                                    </div>

                                    <div class="field">
                                        <label>Last Name <span>*</span></label>
                                        <input type="text" placeholder="dela Cruz" name="last_name"
                                            value="{{ old('last_name') }}" id="lastName" />
                                    </div>
                                </div>

                                <div class="field">
                                    <label>Email Address <span>*</span></label>
                                    <input type="email" placeholder="juan@email.com" name="email"
                                        value="{{ old('email') }}" id="emailInput" />
                                </div>

                                <div class="field">
                                    <label>Phone Number <span>*</span></label>
                                    <input type="tel" placeholder="+63 9XX XXX XXXX" name="phone_number"
                                        value="{{ old('phone_number') }}" id="phoneInput" />
                                </div>

                                <div class="field">
                                    <label>Password <span>*</span></label>

                                    <div class="pw-wrap">
                                        <input type="password" placeholder="Min. 8 characters" name="password"
                                            id="pwInput" oninput="checkStrength()" />

                                        <button class="pw-eye" onclick="togglePw('pwInput',this)" type="button">
                                            👁
                                        </button>
                                    </div>

                                    <div class="strength-bar">
                                        <div class="strength-seg" id="seg1"></div>
                                        <div class="strength-seg" id="seg2"></div>
                                        <div class="strength-seg" id="seg3"></div>
                                        <div class="strength-seg" id="seg4"></div>
                                    </div>

                                    <p class="field-hint" id="strengthLabel">
                                        Enter a password
                                    </p>
                                </div>

                                <div class="field">
                                    <label>Confirm Password <span>*</span></label>

                                    <div class="pw-wrap">
                                        <input type="password" placeholder="Re-enter password"
                                            name="password_confirmation" id="pw2Input" />

                                        <button class="pw-eye" onclick="togglePw('pw2Input',this)" type="button">
                                            👁
                                        </button>
                                    </div>
                                </div>

                                <label class="check-field">
                                    <input type="checkbox" name="terms" id="termsCheck" />

                                    <span>
                                        I agree to the
                                        <a href="#">Terms of Service</a>
                                        and
                                        <a href="#">Privacy Policy</a>
                                    </span>
                                </label>


                                <button type="submit" class="btn-full">
                                    Continue →
                                </button>
                            </form>
                            <button class="btn-back" type="button" onclick="goStep(1)">← Back</button>
                        </div>


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

                        <form method="POST" action="{{ route('landlord-details.store') }}">
                            @csrf
                            <input type="hidden" name="account_id" value="{{ session('account_id') }}" />
                            @if ($errors->any())
                                <div style="background:red;color:white;padding:10px;">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="field-group">
                                <div class="field">
                                    <label>Property Name <span>*</span></label>
                                    <input type="text" name="property_name"
                                        placeholder="e.g. Sunshine Dormitory" />
                                </div>
                                <div class="field">
                                    <label>Property Type <span>*</span></label>
                                    <select name="property_type">
                                        <option value="">Select type...</option>
                                        <option value="boarding_house">Boarding House</option>
                                        <option value="apartment">Apartment</option>
                                        <option value="dormitory">Dormitory</option>
                                        <option value="bedspace">Bed Space</option>
                                        <option value="studio_unit">Studio Unit</option>
                                    </select>
                                </div>
                                <div class="field-row">
                                    <div class="field">
                                        <label>Number of Floors</label>
                                        <input type="number" name="number_of_floors" placeholder="e.g. 3"
                                            min="1" />
                                    </div>
                                    <div class="field">
                                        <label>Number of Rooms <span>*</span></label>
                                        <input type="number" name="number_of_rooms" placeholder="e.g. 10"
                                            min="1" />
                                    </div>
                                </div>
                                <div class="field-row">
                                    <div class="field">
                                        <label>Beds per Room <span>*</span></label>
                                        <input type="number" name="bed_per_room" placeholder="e.g. 4"
                                            min="1" />
                                    </div>
                                    <div class="field">
                                        <label>Monthly Rent (₱) <span>*</span></label>
                                        <input type="number" name="monthly_rent" placeholder="e.g. 3500" />
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Full Address <span>*</span></label>
                                    <input type="text" name="full_address" placeholder="Street, Barangay, City" />
                                </div>
                                <div class="field">
                                    <label>Amenities</label>
                                    <p class="field-hint" style="margin-bottom:.4rem;">Select all that apply</p>
                                    <div class="amenity-grid">

                                        <label>
                                            <input type="checkbox" name="amenities[]" value="WiFi">
                                            📶 WiFi
                                        </label>

                                        <label>
                                            <input type="checkbox" name="amenities[]" value="Aircon">
                                            ❄️ Aircon
                                        </label>

                                        <label>
                                            <input type="checkbox" name="amenities[]" value="ElectricFan">
                                            🌀 Electric Fan
                                        </label>

                                        <label>
                                            <input type="checkbox" name="amenities[]" value="PrivateCR">
                                            🚿 Private CR
                                        </label>

                                        <label>
                                            <input type="checkbox" name="amenities[]" value="SharedCR">
                                            🚿 Shared CR
                                        </label>

                                        <label>
                                            <input type="checkbox" name="amenities[]" value="Kitchen">
                                            🍳 Kitchen
                                        </label>

                                        <label>
                                            <input type="checkbox" name="amenities[]" value="LaundryArea">
                                            🧺 Laundry Area
                                        </label>

                                        <label>
                                            <input type="checkbox" name="amenities[]" value="TV">
                                            📺 TV
                                        </label>

                                        <label>
                                            <input type="checkbox" name="amenities[]" value="CCTV">
                                            🔐 CCTV
                                        </label>

                                        <label>
                                            <input type="checkbox" name="amenities[]" value="Parking">
                                            🚗 Parking
                                        </label>

                                    </div>
                                </div>
                                <div class="field">
                                    <label>Description / House Rules</label>
                                    <textarea name="house_rules" placeholder="e.g. No smoking, visitors until 9pm only, quiet hours after 10pm..."></textarea>
                                </div>
                            </div>

                            <button class="btn-full" type="submit">Continue →</button>
                        </form>

                        <button class="btn-back" onclick="goStep(2)">← Back</button>
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

                    <!-- ═══════════════════════════════════════ -->
                    <!-- STEP 4: CONFIRM -->
                    <!-- ═══════════════════════════════════════ -->

                    <div class="step-slide" id="step4">

                        <div class="form-head">
                            <h1>Almost there!</h1>
                            <p>Review your information before creating your account</p>
                        </div>


                        <!-- ===================================== -->
                        <!-- LANDLORD SUMMARY -->
                        <!-- ===================================== -->

                        <div id="landlordSummary" class="role-summary">

                            <div class="summary-title">
                                🏡 Property Information
                            </div>

                            <div class="summary-card">

                                <div class="summary-row">
                                    <span>Property Name</span>
                                    <strong>
                                        {{ $landlordDetail->property_name ?? 'Not filled' }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Property Type</span>
                                    <strong>
                                        {{ $landlordDetail->property_type ?? 'Not filled' }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Number of Rooms</span>
                                    <strong>
                                        {{ $landlordDetail->number_of_rooms ?? 'Not filled' }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Beds Per Room</span>
                                    <strong>
                                        {{ $landlordDetail->bed_per_room ?? 'Not filled' }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Monthly Rent</span>
                                    <strong>
                                        {{ isset($landlordDetail->monthly_rent) ? '₱' . number_format($landlordDetail->monthly_rent, 2) : 'Not filled' }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Address</span>
                                    <strong>
                                        {{ $landlordDetail->full_address ?? 'Not filled' }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Amenities</span>
                                    <strong>
                                        {{ !empty($landlordDetail->amenities) ? implode(', ', $landlordDetail->amenities) : 'None' }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>House Rules</span>
                                    <strong>
                                        {{ $landlordDetail->house_rules ?? 'None' }}
                                    </strong>
                                </div>

                            </div>

                        </div>


                        <!-- ===================================== -->
                        <!-- TENANT SUMMARY -->
                        <!-- ===================================== -->

                        <div id="tenantSummary" class="role-summary" style="display:none;">

                            <div class="summary-title">
                                🙋 Tenant Information
                            </div>

                            <div class="summary-card">

                                <div class="summary-row">
                                    <span>Full Name</span>
                                    <strong id="summaryFullName">
                                        {{ session('tenant_full_name', 'Not filled') }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Date of Birth</span>
                                    <strong id="summaryBirthdate">
                                        {{ session('tenant_birthdate', 'Not filled') }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Gender</span>
                                    <strong id="summaryGender">
                                        {{ session('tenant_gender', 'Not filled') }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Occupation / School</span>
                                    <strong id="summaryOccupation">
                                        {{ session('tenant_occupation', 'Not filled') }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Preferred Location</span>
                                    <strong id="summaryLocation">
                                        {{ session('tenant_location', 'Not filled') }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Budget</span>
                                    <strong id="summaryBudget">
                                        {{ session('tenant_budget', 'Not filled') }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Room Type</span>
                                    <strong id="summaryRoomType">
                                        {{ session('tenant_room_type', 'Any type') }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Emergency Contact</span>
                                    <strong id="summaryEmergency">
                                        {{ session('tenant_emergency_name', 'Not filled') }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Emergency Number</span>
                                    <strong id="summaryEmergencyNumber">
                                        {{ session('tenant_emergency_number', 'Not filled') }}
                                    </strong>
                                </div>

                            </div>

                        </div>


                        <!-- ===================================== -->
                        <!-- EMAIL VERIFICATION -->
                        <!-- ===================================== -->

                        <div class="verify-box">

                            <span class="verify-icon">📧</span>

                            <h3>Verify your email</h3>

                            <p>
                                We sent a 6-digit code to
                                <strong id="emailDisplay">
                                    {{ session('otp_email') }}
                                </strong>
                            </p>

                            <p>
                                Enter the code below to create your account.
                            </p>


                            <!-- OTP FORM -->

                            <form id="otpForm" method="POST" action="{{ route('verify-otp') }}">

                                @csrf


                                <div class="otp-wrap">

                                    <input type="text" maxlength="1" class="otp-input" inputmode="numeric"
                                        autocomplete="one-time-code" name="otp1" oninput="otpNext(this, 0)"
                                        onkeydown="otpBack(event, 0)" />

                                    <input type="text" maxlength="1" class="otp-input" inputmode="numeric"
                                        name="otp2" oninput="otpNext(this, 1)" onkeydown="otpBack(event, 1)" />

                                    <input type="text" maxlength="1" class="otp-input" inputmode="numeric"
                                        name="otp3" oninput="otpNext(this, 2)" onkeydown="otpBack(event, 2)" />

                                    <input type="text" maxlength="1" class="otp-input" inputmode="numeric"
                                        name="otp4" oninput="otpNext(this, 3)" onkeydown="otpBack(event, 3)" />

                                    <input type="text" maxlength="1" class="otp-input" inputmode="numeric"
                                        name="otp5" oninput="otpNext(this, 4)" onkeydown="otpBack(event, 4)" />

                                    <input type="text" maxlength="1" class="otp-input" inputmode="numeric"
                                        name="otp6" oninput="otpNext(this, 5)" onkeydown="otpBack(event, 5)" />

                                </div>


                                <!-- COMPLETE OTP -->

                                <input type="hidden" name="otp" id="otp" />


                                <p id="otpMessage"></p>


                                <p class="resend">
                                    Didn't get it?

                                    <a href="#" onclick="resendCode(event)">
                                        Resend code
                                    </a>
                                </p>


                                <!-- CREATE ACCOUNT -->

                                <button type="submit" class="btn-full" id="btnSubmit">

                                    🎉 Create My Account

                                </button>

                            </form>

                        </div>


                        <!-- BACK -->

                        <button type="button" class="btn-back" onclick="goBackFromStep4()">

                            ← Back

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
        const otpInputs = document.querySelectorAll('.otp-input');


        function otpNext(input, index) {
            // Only allow numbers
            input.value = input.value.replace(/[^0-9]/g, '');

            // Move to next box
            if (input.value.length === 1 && index < 5) {
                otpInputs[index + 1].focus();
            }

            updateOTP();
        }


        function otpBack(event, index) {
            if (
                event.key === 'Backspace' &&
                otpInputs[index].value === ''
            ) {

                if (index > 0) {
                    otpInputs[index - 1].focus();
                }
            }

            updateOTP();
        }


        function updateOTP() {
            let otp = '';

            otpInputs.forEach(function(input) {
                otp += input.value;
            });

            document.getElementById('otp').value = otp;
        }


        document.getElementById('otpForm').addEventListener('submit', function(event) {
            updateOTP();

            const otp = document.getElementById('otp').value;

            if (otp.length !== 6) {

                event.preventDefault();

                document.getElementById('otpMessage').innerHTML =
                    '<span style="color:red;">Please enter the complete 6-digit code.</span>';

                return;
            }

            // Change button text
            document.getElementById('btnSubmit').innerHTML =
                '⏳ Creating Account...';

            // Disable button to prevent double-click
            document.getElementById('btnSubmit').disabled = true;
        });
    </script>
    <script>
        /* ── STATE ── */
        let currentStep = 1;

        let selectedRole =
            "{{ session('selected_role') ?? (old('role') ?? '') }}";

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

            document.getElementById('roleInput').value = role;

            document.querySelectorAll('.role-option')
                .forEach(el => el.classList.remove('selected'));

            document.getElementById(
                'role' + role.charAt(0).toUpperCase() + role.slice(1)
            ).classList.add('selected');

            const info = document.getElementById('roleInfo');

            info.innerHTML = roleInfo[role];
            info.style.display = 'block';

            document.getElementById('btnStep1').disabled = false;

            document.getElementById('s2title').textContent =
                role === 'landlord' ?
                'Landlord Account' :
                'Tenant Account';

            document.getElementById('s2sub').textContent =
                role === 'landlord' ?
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

        document.addEventListener('DOMContentLoaded', function() {

            console.log('Role from session:', selectedRole);

            @if (session('step'))
                goStep({{ session('step') }});
            @endif

        });
    </script>
</body>

</html>
