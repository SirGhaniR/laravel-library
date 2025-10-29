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
      <li><a href="home" class="nav-link px-2">Home</a></li>
      <li><a href="book" class="nav-link px-2">Books</a></li>
      <li><a href="category" class="nav-link link-secondary px-2">Categories</a></li>
    </ul>
    <div class="col-md-3 text-end">
      <button type="button" class="btn btn-outline-primary me-2">
        Login
      </button>
      <button type="button" class="btn btn-primary">Sign-up</button>
    </div>
  </header>

  <div class="container my-5">
    <div class="card mb-3">
      <div class="card-header">
        Hello!
      </div>
      <div class="card-body">
        <h5 class="card-title">Add new category</h5>


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

        <form method="POST">
          @csrf
          <div class="row my-3">
            <label for="category" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="category" name="category_name"
                value="{{ old('category_name') }}" placeholder="Insert new category here.">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

    <div class="container rounded border">
      <table class="table-hover table align-middle">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Category Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($datas as $data)
            <tr>
              <th scope="row">{{ $loop->index + 1 }}</th>
              <td>{{ $data->category_name }}</td>
              <td class="d-flex gap-2">
                <a href="category/{{ $data->id }}" class="btn btn-warning">Update</a>
                <form action="category/{{ $data->id }}" method="post">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
