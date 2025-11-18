<x-header />
<section class="d-flex justify-content-center container pt-5">
  <div class="card w-75 px-5 py-4">
    <h2 class="mb-4">Login</h2>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          {{ $error }}
        @endforeach
      </div>
    @endif

    <form action="/auth" method="post">
      @csrf
      <div class="mb-4">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com"
          value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>">
      </div>
      <div class="col-sm mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password"
          placeholder="Enter a strong password">
      </div>
      <div class="d-flex flex-column align-items-start">
        <button type="submit" class="btn btn-primary mb-3">Login</button>
        <span>Don't have an account? <a href="/register">Register</a></span>
      </div>
    </form>
  </div>
</section>
<x-footer />
