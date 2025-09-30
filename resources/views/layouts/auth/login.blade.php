@extends('layouts.main')

@section('title', 'Login')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
  <div class="login-container">
      <div id="header">
        <div class="title"><img id="logo" src="images/logo.png"><div id="role"><span>LOGIN</span></div></div>
      </div>
      <form action="" method="POST">
        <div class="input-field-group">
          <input type="email" id="email" placeholder="Email" name="email" required>

          <div class="password-wrapper">
              <input type="password" id="password" placeholder="Password" name="password" required>
              <img class="eyeIcon" id="eyeIcon" src="images/eye-close.jpg" alt="Toggle Password">
          </div>

          <div id="regButton">
            <a href="Registration.php" class="signup-link">SIGN UP</a>
            <a href="/forgot-password" class="forgot-link">FORGOT PASSWORD?</a>
            <div class="error-section">
              <img class="errorIcon" id="errorIcon" src="images/warning.jpg" alt="!">
            <div id="errorSummary" class="errorSummary"></div>
        </div>
          </div>
        </div>

        <div class="submit-section">
          <button class="submit-btn" type="submit" name="login">Sign In</button>
        </div>

        <div class="social-login">
            <p>or sign in with</p>
            <div class="social-buttons">
            <a href="{{ url('auth/google') }}">
                <img class="google-btn" src="{{ asset('images/google-icon.png') }}" alt="Login with Google">
            </a>
            <a href="{{ url('auth/facebook') }}">
                <img class="facebook-btn" src="{{ asset('images/facebook-icon.png') }}" alt="Login with Facebook">
            </a>
            </div>
        </div>
      </form>
    </div>
@endsection

@push('scripts')
  <script src="{{ asset('js/login.js') }}"></script>
@endpush
