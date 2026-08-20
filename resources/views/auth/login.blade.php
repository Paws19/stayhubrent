<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>StayHubRent — Sign In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>

    <!-- NAV -->
    <nav>
        <a href="{{ route('index') }}" class="nav-logo"><span class="logo-pip"></span>StayHubRent</a>
        <div class="nav-right">
            <a href="{{ route('index') }}" class="nav-back">← <span>Back to Home</span></a>
            <button class="theme-btn" id="themeBtn" title="Toggle theme">🌙</button>
        </div>
    </nav>

    <!-- PAGE -->
    <div class="page">
        <div class="page-orb page-orb1"></div>
        <div class="page-orb page-orb2"></div>
        <div class="page-orb page-orb3"></div>

        <div class="right-panel">

            <!-- Page header -->
            <div class="page-header">
                <div class="page-badge"><span class="badge-dot"></span>Welcome back</div>
                <h1 class="page-title">Sign in to your account</h1>
                <p class="page-sub">Manage your rentals or find your next room</p>
            </div>

            <div class="form-card">
                <div class="form-shell">

                    <div class="form-head">
                        <h1>Sign in</h1>
                        <p>Enter your credentials to continue</p>
                    </div>

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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf

                        <div class="field-group">
                            <div class="field">
                                <label>Email Address <span>*</span></label>
                                <input type="email" name="email" placeholder="juan@email.com"
                                    value="{{ old('email') }}" id="emailInput" autofocus />
                            </div>

                            <div class="field">
                                <label>Password <span>*</span></label>
                                <div class="pw-wrap">
                                    <input type="password" name="password" placeholder="Enter your password"
                                        id="pwInput" />
                                    <button class="pw-eye" type="button"
                                        onclick="togglePw('pwInput', this)">👁</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-row-between">
                            <label class="check-field">
                                <input type="checkbox" name="remember" />
                                <span>Remember me</span>
                            </label>
                            <a href="" class="forgot-link">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn-full" id="btnLogin">
                            Sign In <span>→</span>
                        </button>
                    </form>

                    <div class="or-line">or continue with</div>

                    <div class="social-btns">
                        <button class="social-btn" type="button">🔵 Google</button>
                        <button class="social-btn" type="button">📘 Facebook</button>
                    </div>

                    <p class="signin-link">Don't have an account? <a href="{{ route('get-started') }}">Create one</a>
                    </p>

                </div><!-- /form-shell -->
            </div><!-- /form-card -->
        </div><!-- /right-panel -->
    </div><!-- /page -->

    <script>
        /* ── THEME ── */
        const themeBtn = document.getElementById('themeBtn');
        themeBtn.addEventListener('click', () => {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            document.documentElement.setAttribute('data-theme', isDark ? 'light' : 'dark');
            themeBtn.textContent = isDark ? '🌙' : '☀️';

            try {
                localStorage.setItem('shr-theme', isDark ? 'light' : 'dark');
            } catch (e) {}
        });

        try {
            const saved = localStorage.getItem('shr-theme');
            if (saved) {
                document.documentElement.setAttribute('data-theme', saved);
                themeBtn.textContent = saved === 'dark' ? '🌙' : '☀️';
            }
        } catch (e) {}

        /* ── PASSWORD TOGGLE ── */
        function togglePw(id, btn) {
            const inp = document.getElementById(id);
            inp.type = inp.type === 'password' ? 'text' : 'password';
            btn.textContent = inp.type === 'password' ? '👁' : '🙈';
        }

        /* ── SUBMIT STATE ── */
        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('btnLogin');
            btn.innerHTML = '⏳ Signing in...';
            btn.disabled = true;
        });
    </script>
</body>

</html>
