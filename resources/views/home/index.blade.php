<x-header :current-page="$currentPage" />
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
<x-footer />
