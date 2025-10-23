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
          <li class="nav-item"><a class="nav-link" href="{{ route('books') }}">Books</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('user.dashboard') }}">User</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
        </ul>

        <div class="ms-3 d-flex gap-2">
          <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
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
        <form>
          <div class="mb-3">
            <label class="form-label fw-semibold">Email address</label>
            <input type="email" class="form-control" placeholder="Enter your email">
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control" placeholder="Enter your password">
          </div>
          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label for="rememberMe" class="form-check-label">Remember me</label>
          </div>
          <button type="button" class="btn btn-primary w-100">Login</button>
        </form>
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
        <form>
          <div class="mb-3">
            <label class="form-label fw-semibold">Full Name</label>
            <input type="text" class="form-control" placeholder="Enter your name">
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control" placeholder="Enter your email">
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control" placeholder="Create a password">
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm your password">
          </div>
          <button type="button" class="btn btn-success w-100">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>