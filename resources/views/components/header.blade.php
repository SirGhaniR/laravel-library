<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category</title>
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
      @props(['currentPage' => ''])
      <li><a href="{{ $currentPage != 'home' ? url('/') : '#' }}" class="nav-link px-2">Home</a></li>
      <li><a href="{{ $currentPage != 'home' ? url('admin/book') : url('book') }}" class="nav-link px-2">Books</a></li>
      <li><a href="{{ $currentPage != 'home' ? url('admin/category') : url('category') }}"
          class="nav-link px-2">Categories</a></li>
      <li><a href="{{ $currentPage != 'home' ? url('admin/borrow') : url('borrow') }}" class="nav-link px-2">Borrows</a>
      </li>
    </ul>
    <div class="col-md-3 text-end">
      <button type="button" class="btn btn-outline-primary me-2">
        Login
      </button>
      <button type="button" class="btn btn-primary">Sign-up</button>
    </div>
  </header>
