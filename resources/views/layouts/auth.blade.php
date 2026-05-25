<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vehicle Maintenance — Sign In</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; }

    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #F0F4FB;
      font-family: 'DM Sans', sans-serif;
      padding: 2rem;
    }

    .vm-card {
      display: flex;
      width: 100%;
      max-width: 760px;
      background: #ffffff;
      border: 1px solid #E2EAF4;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(30, 58, 138, 0.08);
      min-height: 460px;
    }

    .vm-left {
      width: 46%;
      background: #EEF4FF;
      padding: 2.5rem 1.75rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 1.2rem;
    }

    .vm-car-circle {
      width: 110px;
      height: 110px;
      border-radius: 50%;
      background: #D6E4FF;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 52px;
    }

    .vm-brand { text-align: center; }
    .vm-brand h2 {
      font-family: 'Sora', sans-serif;
      font-size: 15px;
      font-weight: 700;
      color: #1E3A8A;
      margin: 0 0 5px;
    }
    .vm-brand p { font-size: 12.5px; color: #4A6FA5; margin: 0; }

    .vm-features { display: flex; flex-direction: column; gap: 8px; width: 100%; }

    .vm-feat {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #ffffff;
      border: 1px solid #C7D9F7;
      border-radius: 10px;
      padding: 10px 14px;
    }
    .vm-feat i { font-size: 18px; color: #2563EB; flex-shrink: 0; }
    .vm-feat-text p { margin: 0; }
    .vm-feat-text .ft { font-size: 12.5px; font-weight: 600; color: #1E3A8A; }
    .vm-feat-text .fs { font-size: 11px; color: #5A7DB5; }

    .vm-dots { display: flex; gap: 6px; justify-content: center; }
    .vm-dot { width: 8px; height: 8px; border-radius: 50%; background: #2563EB; }
    .vm-dot.inactive { background: #C7D9F7; }

    .vm-right {
      flex: 1;
      padding: 2.75rem 2.25rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .vm-title { display: flex; align-items: center; gap: 10px; margin-bottom: 1.8rem; }
    .vm-title i { font-size: 24px; color: #2563EB; }
    .vm-title h1 {
      font-family: 'Sora', sans-serif;
      font-size: 21px;
      font-weight: 700;
      margin: 0;
      color: #111827;
      letter-spacing: -0.3px;
    }
    .vm-title h1 span { color: #2563EB; }

    .vm-field { margin-bottom: 1rem; }
    .vm-label { font-size: 13.5px; font-weight: 500; color: #374151; margin-bottom: 6px; display: block; }
    .vm-input {
      width: 100%;
      padding: 10px 14px;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      border: 1px solid #D1D5DB;
      border-radius: 9px;
      background: #ffffff;
      color: #111827;
      outline: none;
      transition: border 0.15s, box-shadow 0.15s;
    }
    .vm-input::placeholder { color: #9CA3AF; }
    .vm-input:focus { border-color: #2563EB; box-shadow: 0 0 0 3px rgba(37,99,235,0.12); }
    .vm-input.is-invalid { border-color: #EF4444; }

    .invalid-feedback { font-size: 12px; color: #EF4444; margin-top: 4px; display: block; }

    .vm-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem; }
    .vm-check { display: flex; align-items: center; gap: 7px; font-size: 13.5px; color: #374151; cursor: pointer; }
    .vm-check input { margin: 0; cursor: pointer; }
    .vm-forgot { font-size: 13.5px; color: #2563EB; text-decoration: none; font-weight: 500; }
    .vm-forgot:hover { text-decoration: underline; }

    .vm-btn {
      width: 100%;
      padding: 12px;
      font-family: 'Sora', sans-serif;
      font-size: 14.5px;
      font-weight: 600;
      background: #1E3A8A;
      color: #ffffff;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: background 0.15s;
      margin-bottom: 1rem;
    }
    .vm-btn:hover { background: #2563EB; }

    .vm-divider { display: flex; align-items: center; gap: 10px; margin-bottom: 1rem; }
    .vm-divider-line { flex: 1; height: 1px; background: #E5E7EB; }
    .vm-divider span { font-size: 12px; color: #9CA3AF; }

    .vm-google {
      width: 100%;
      padding: 11px;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      font-weight: 500;
      background: #ffffff;
      color: #111827;
      border: 1px solid #D1D5DB;
      border-radius: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: background 0.15s;
      margin-bottom: 1.25rem;
      text-decoration: none;
    }
    .vm-google:hover { background: #F9FAFB; }

    .vm-signup { text-align: center; font-size: 13.5px; color: #6B7280; margin: 0; }
    .vm-signup a { color: #2563EB; font-weight: 500; text-decoration: none; }
    .vm-signup a:hover { text-decoration: underline; }

    .alert-error {
      background: #FEF2F2;
      border: 1px solid #FECACA;
      color: #DC2626;
      border-radius: 9px;
      padding: 10px 14px;
      font-size: 13.5px;
      margin-bottom: 1rem;
    }

    @media (max-width: 600px) {
      .vm-card { flex-direction: column; }
      .vm-left { width: 100%; padding: 2rem 1.5rem; }
      .vm-right { padding: 2rem 1.5rem; }
    }
  </style>
</head>
<body>

<div class="vm-card">

  {{-- Left panel --}}
  <div class="vm-left">
    <div class="vm-car-circle">🚗</div>
    <div class="vm-brand">
      <h2>Vehicle Maintenance System</h2>
      <p>Your complete fleet health at a glance</p>
    </div>
    <div class="vm-features">
      <div class="vm-feat">
        <i class="ti ti-tools"></i>
        <div class="vm-feat-text">
          <p class="ft">Service History</p>
          <p class="fs">Track all past maintenance records</p>
        </div>
      </div>
      <div class="vm-feat">
        <i class="ti ti-alert-triangle"></i>
        <div class="vm-feat-text">
          <p class="ft">Upcoming Services</p>
          <p class="fs">Never miss a scheduled checkup</p>
        </div>
      </div>
      <div class="vm-feat">
        <i class="ti ti-chart-bar"></i>
        <div class="vm-feat-text">
          <p class="ft">Fleet Overview</p>
          <p class="fs">Monitor all vehicles in one place</p>
        </div>
      </div>
    </div>
    <div class="vm-dots">
      <div class="vm-dot"></div>
      <div class="vm-dot inactive"></div>
      <div class="vm-dot inactive"></div>
    </div>
  </div>

  {{-- Right panel --}}
  <div class="vm-right">
    <div class="vm-title">
      <h1>FLEETSYNC <span>PORTAL</span></h1>
    </div>

    {{-- Session errors --}}
    @if ($errors->any())
      <div class="alert-error">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="vm-field">
        <label class="vm-label" for="email">Email Address</label>
        <input
          class="vm-input @error('email') is-invalid @enderror"
          type="email"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="example@gmail.com"
          required
          autofocus
        />
        @error('email')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="vm-field">
        <label class="vm-label" for="password">Password</label>
        <input
          class="vm-input @error('password') is-invalid @enderror"
          type="password"
          id="password"
          name="password"
          placeholder="Your password"
          required
        />
        @error('password')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="vm-row">
        <label class="vm-check">
          <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
          Remember me
        </label>
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="vm-forgot">Forgot password?</a>
        @endif
      </div>

      <button type="submit" class="vm-btn">
        Sign In <i class="ti ti-arrow-right"></i>
      </button>

    </form>

    {{-- Optional: Google OAuth (requires Laravel Socialite) --}}
    {{-- 
    <div class="vm-divider">
      <div class="vm-divider-line"></div>
      <span>or</span>
      <div class="vm-divider-line"></div>
    </div>
    <a href="{{ route('auth.google') }}" class="vm-google">
      <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844c-.209 1.125-.843 2.078-1.796 2.717v2.258h2.908c1.702-1.567 2.684-3.875 2.684-6.615z" fill="#4285F4"/>
        <path d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18z" fill="#34A853"/>
        <path d="M3.964 10.71A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.996 8.996 0 0 0 0 9c0 1.452.348 2.827.957 4.042l3.007-2.332z" fill="#FBBC05"/>
        <path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.958L3.964 7.29C4.672 5.163 6.656 3.58 9 3.58z" fill="#EA4335"/>
      </svg>
      Sign in with Google
    </a>
    --}}

    @if (Route::has('register'))
      <p class="vm-signup">Don't have an account? <a href="{{ route('register') }}">Create one here</a></p>
    @endif

  </div>
</div>

</body>
</html>