<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @props(['currentPage' => '', 'title' => null])
  <title>{{ $title ?? ucfirst($currentPage) . ' - Laravel Library' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <header
    class="d-flex align-items-center justify-content-center justify-content-md-between border-bottom mb-4 flex-wrap p-3">
    <div class="col-md-3 mb-md-0 mb-2">
      <a href="/"
        class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none mb-3">
        <span class="fs-4">Laravel Library</span>
      </a>
    </div>
    <ul class="nav col-12 col-md-auto justify-content-center mb-md-0 mb-2">
      <li><a href="{{ $currentPage != 'home' ? url('/') : '#' }}" class="nav-link px-2">Home</a></li>
      @auth
        @if (Auth::user()->role()->where('role_name', 'member')->exists())
          <li><a href="{{ $currentPage != 'home' ? url('member/books') : url('book') }}" class="nav-link px-2">Books</a>
          </li>
          <li><a href="{{ $currentPage != 'home' ? url('member/categories') : url('category') }}"
              class="nav-link px-2">Categories</a></li>
          <li><a href="{{ $currentPage != 'home' ? url('member/borrows') : url('borrow') }}"
              class="nav-link px-2">Borrows</a>
          </li>
        @else
          <li><a href="{{ $currentPage != 'home' ? url('admin/book') : url('book') }}" class="nav-link px-2">Books</a>
          </li>
          <li><a href="{{ $currentPage != 'home' ? url('admin/category') : url('category') }}"
              class="nav-link px-2">Categories</a></li>
          <li><a href="{{ $currentPage != 'home' ? url('admin/borrow') : url('borrow') }}"
              class="nav-link px-2">Borrows</a>
          </li>
        @endif
      @else
        <li><a href="{{ $currentPage != 'home' ? url('admin/book') : url('book') }}" class="nav-link px-2">Books</a></li>
        <li><a href="{{ $currentPage != 'home' ? url('admin/category') : url('category') }}"
            class="nav-link px-2">Categories</a></li>
        <li><a href="{{ $currentPage != 'home' ? url('admin/borrow') : url('borrow') }}"
            class="nav-link px-2">Borrows</a>
        </li>
      @endauth
    </ul>
    <div class="col-md-3 text-end">
      @auth
        <span class="me-3">Welcome, {{ Auth::user()->name }}!</span>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Sign-up</a>
      @endauth
    </div>
  </header>
