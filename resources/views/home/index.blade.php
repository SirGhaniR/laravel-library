<x-header :current-page="$currentPage" />
<main>
  <div class="my-5 px-4 py-5 text-center">

    @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          {{ $error }}
        @endforeach
      </div>
    @endif

    <h1 class="display-5 fw-bold text-body-emphasis">Laravel Library</h1>
    <div class="col-lg-6 mx-auto">
      @auth
        @if ($isAdmin)
          <p class="lead mb-4">
            Welcome back, {{ Auth::user()->name }}! Manage our library collection and help us become the largest
            website-based public library in the world.
          </p>
          <div class="d-grid d-sm-flex justify-content-sm-center mb-3 gap-2">
            <a href="admin/book">
              <button type="button" class="btn btn-primary btn-lg gap-3 px-4">
                Manage Books
              </button>
            </a>
            <a href="admin/category">
              <button type="button" class="btn btn-secondary btn-lg px-4">
                Manage Categories
              </button>
            </a>
            <a href="admin/borrow">
              <button type="button" class="btn btn-success btn-lg px-4">
                Manage Borrows
              </button>
            </a>
          </div>
          <div class="text-center">
            <a href="{{ route('register') }}" class="btn btn-outline-primary">
              Create New Account
            </a>
          </div>
        @elseif($isMember)
          <p class="lead mb-4">
            Welcome back, {{ Auth::user()->name }}! Browse our library collection and discover your next great read.
          </p>
          <div class="d-grid d-sm-flex justify-content-sm-center mb-3 gap-2">
            <a href="{{ route('member.books') }}">
              <button type="button" class="btn btn-primary btn-lg gap-3 px-4">
                Browse Books
              </button>
            </a>
            <a href="{{ route('member.categories') }}">
              <button type="button" class="btn btn-outline-secondary btn-lg px-4">
                Browse Categories
              </button>
            </a>
            <a href="{{ route('member.borrows') }}">
              <button type="button" class="btn btn-outline-success btn-lg px-4">
                My Borrow History
              </button>
            </a>
          </div>
        @endif
      @else
        <p class="lead mb-4">
          Welcome to our library management system! Please login to access the admin features and manage our book
          collection.
        </p>
        <div class="d-grid d-sm-flex justify-content-sm-center gap-2">
          <a href="{{ route('login') }}">
            <button type="button" class="btn btn-primary btn-lg gap-3 px-4">
              Login to Admin Panel
            </button>
          </a>
        </div>
        <p class="text-muted mt-3 text-center">
          <small>New admin accounts can only be created by existing administrators.</small>
        </p>
      @endauth
    </div>
  </div>
</main>
<x-footer />
