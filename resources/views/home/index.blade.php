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
      <li><a href="home" class="nav-link link-secondary px-2">Home</a></li>
      <li><a href="admin/book" class="nav-link px-2">Books</a></li>
      <li><a href="admin/category" class="nav-link px-2">Categories</a></li>
    </ul>
    <div class="col-md-3 text-end">
      <button type="button" class="btn btn-outline-primary me-2">
        Login
      </button>
      <button type="button" class="btn btn-primary">Sign-up</button>
    </div>
  </header>

  <main>
    <div class="my-5 px-4 py-5 text-center">
      <h1 class="display-5 fw-bold text-body-emphasis">Laravel Library</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">
          Become our admin to support us with managing all the books in our public library! Your support will be our
          greatest help and greatly appreaciated. We hope to be the largest website-based public library in the world.
          Thank you!
        </p>
        <div class="d-grid d-sm-flex justify-content-sm-center gap-2">
          <a href="admin/book">
            <button type="button" class="btn btn-primary btn-lg gap-3 px-4">
              Books
            </button>
          </a>
          <a href="admin/category">
            <button type="button" class="btn btn-outline-secondary btn-lg px-4">
              Categories
            </button>
          </a>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
