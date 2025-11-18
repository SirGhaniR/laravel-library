<x-header />
<section class="d-flex justify-content-center container my-5">
  <div class="card w-75 px-5 py-4">
    <h2 class="mb-4">Create Member</h2>

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

    <form action="/create-member" method="post">
      @csrf
      <div class="mb-4">
        <label for="full_name" class="form-label">Full name</label>
        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter your full name">
      </div>
      <div class="mb-4">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
      </div>
      <div class="row mb-2">
        <div class="col-sm mb-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password"
            placeholder="Enter a strong password">
        </div>
        <div class="col-sm mb-4">
          <label for="password_confirmation" class="form-label">Password confirmation</label>
          <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
            placeholder="Re-enter your password">
        </div>
      </div>
      <div class="mb-4">
        <label for="role" class="form-label">Select Role</label>
        <select class="form-select" name="role" id="role">
          <option selected disabled class="text-secondary">Select the role for this account</option>
          <?php foreach ($data as $role) : ?>
          <option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="d-flex flex-column align-items-start">
        <button type="submit" class="btn btn-primary mb-3">Create Account</button>
        <span>Have an account? <a href="/auth">Login</a></span>
      </div>
    </form>
  </div>
</section>
<x-footer />
