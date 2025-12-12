<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ route('home') }}">
        <img src="{{ asset('images/logo.png') }}" alt="BookVerse Logo" height="40" class="me-2">
        BookVerse
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('books.list') }}">Books</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
          {{-- <li class="nav-item"><a class="nav-link" href="{{ route('user.dashboard') }}">User</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li> --}}
        </ul>

        <div class="ms-3 d-flex gap-2">
          @auth
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
          @else
            <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
          @endauth
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- ================= LOGIN MODAL ================= -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Login to BookVerse</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Email address</label>
            <input type="email" name="email" class="form-control text-dark" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Password</label>
            <input type="password" name="password" class="form-control text-dark" placeholder="Enter your password" required>
          </div>
          <hr>
          <div class="text-center mt-3">
            <a href="{{ route('auth.google.redirect') }}" class="btn btn-danger w-100">
                <i class="fab fa-google me-2"></i> Login with Google
            </a>
          </div>
          <hr>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                <label for="rememberMe" class="form-check-label text-dark">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-decoration-none small text-primary" href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
            @endif
          </div>
          <div class="mb-3 text-center">
                {!! NoCaptcha::display() !!}
            </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        {!! NoCaptcha::renderJs() !!}
      </div>
    </div>
  </div>
</div>

<!-- ================= REGISTER MODAL ================= -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Create Your BookVerse Account</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <form method="POST" action="{{ route('register') }}">
            @csrf
          <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Full Name</label>
            <input type="text" name="name" class="form-control text-dark" placeholder="Enter your name" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Email</label>
            <input type="email" name="email" class="form-control text-dark" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Password</label>
            <input type="password" name="password" class="form-control text-dark" placeholder="Create a password" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control text-dark" placeholder="Confirm your password" required>
          </div>
          <div class="mb-3 text-center">
                {!! NoCaptcha::display() !!}
            </div>
          <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
        {!! NoCaptcha::renderJs() !!}
      </div>
    </div>
  </div>
</div>