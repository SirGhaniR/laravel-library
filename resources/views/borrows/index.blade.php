<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book</title>
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
      <li><a href="/home" class="nav-link px-2">Home</a></li>
      <li><a href="book" class="nav-link link-secondary px-2">Books</a></li>
      <li><a href="category" class="nav-link px-2">Categories</a></li>
      <li><a href="/borrow" class="nav-link px-2">Borrows</a></li>
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
        <h5 class="card-title">Borrow Books</h5>

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
            <label for="title" class="col-sm-2 col-form-label">Book's Title</label>
            <div class="col-sm-10">
              <select class="form-select" name="title" id="title">
                <option selected disabled>Choose the title of the book that you want to borrow</option>
                @foreach ($books as $book)
                  <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row my-3">
            <label for="member" class="col-sm-2 col-form-label">Member</label>
            <div class="col-sm-10">
              <select class="form-select" name="member" id="member">
                <option selected disabled>Which member would like to borrow</option>
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row my-3">
            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}"
                placeholder="Insert book's quantity here.">
            </div>
          </div>
          <div class="row my-3">
            <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="start_date" name="start_date"
                value="{{ old('start_date') }}"
                placeholder="Insert the date of when you're going to borrow the book here.">
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
            <th scope="col">Book's Title</th>
            <th scope="col">Member</th>
            <th scope="col">Quantity</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Return Date</th>
            <th scope="col">Fine</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($borrows as $borrow)
            <tr>
              <th scope="row">{{ $loop->index + 1 }}</th>
              <td>{{ $borrow->title }}</td>
              <td>{{ $borrow->name }}</td>
              <td>{{ $borrow->quantity }}</td>
              <td>{{ $borrow->start_borrow }}</td>
              <td>{{ $borrow->end_borrow }}</td>
              <td>{{ $borrow->return_borrow }}</td>
              <td>{{ $borrow->fine }}</td>

              <td class="d-flex gap-2">
                <a href="borrow/{{ $borrow->id }}" class="btn btn-warning">Update</a>
                <form action="borrow/{{ $borrow->id }}" method="post">
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
