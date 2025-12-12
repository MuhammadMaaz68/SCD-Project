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
        <!-- Search Bar -->
        <div class="mx-auto position-relative d-none d-lg-block" style="width: 400px;">
            <input type="text" id="search-input" class="form-control" placeholder="Search by name or category..." autocomplete="off">
            <div id="search-results" class="dropdown-menu w-100 mt-1 shadow border-0" style="display: none; max-height: 400px; overflow-y: auto; z-index: 1050;"></div>
        </div>
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
            <input type="email" name="email" class="form-control text-dark @error('email', 'login') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}" required>
            @error('email', 'login')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Password</label>
            <input type="password" name="password" class="form-control text-dark @error('password', 'login') is-invalid @enderror" placeholder="Enter your password" required>
            @error('password', 'login')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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
                @error('g-recaptcha-response', 'login')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
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
            <input type="text" name="name" class="form-control text-dark @error('name', 'register') is-invalid @enderror" placeholder="Enter your name" value="{{ old('name') }}" required>
            @error('name', 'register')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Email</label>
            <input type="email" name="email" class="form-control text-dark @error('email', 'register') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}" required>
            @error('email', 'register')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Password</label>
            <input type="password" name="password" class="form-control text-dark @error('password', 'register') is-invalid @enderror" placeholder="Create a password" required>
            @error('password', 'register')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control text-dark" placeholder="Confirm your password" required>
          </div>
          <div class="mb-3 text-center">
                {!! NoCaptcha::display() !!}
                @error('g-recaptcha-response', 'register')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
          <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
        {!! NoCaptcha::renderJs() !!}
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Correctly handle Named Error Bags
        @if ($errors->login->any())
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        @elseif ($errors->register->any())
            const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
            registerModal.show();
        @endif

        const modals = ['loginModal', 'registerModal'];
        modals.forEach(id => {
            const modalEl = document.getElementById(id);
            if (modalEl) {
                modalEl.addEventListener('hidden.bs.modal', function () {
                    const form = modalEl.querySelector('form');
                    
                    // Remove error styling and messages
                    modalEl.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                    modalEl.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                    modalEl.querySelectorAll('.text-danger').forEach(el => el.remove()); 
                    
                    // Clear inputs
                    form.querySelectorAll('input:not([type=hidden]):not([type=submit])').forEach(input => input.value = '');
                    if(document.getElementById('rememberMe')) document.getElementById('rememberMe').checked = false;
                });
            }
        });
    });
</script>