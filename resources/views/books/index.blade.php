<x-header :current-page="$currentPage" />
<div class="container my-5">
  @if (Auth::user()->role()->where('role_name', 'admin')->exists())
    <div class="card mb-3">
      <div class="card-header">
        Hello!
      </div>
      <div class="card-body">
        <h5 class="card-title">Add new book</h5>

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
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                placeholder="Insert book's title here.">
            </div>
          </div>
          <div class="row my-3">
            <label for="author" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}"
                placeholder="Insert book's author here.">
            </div>
          </div>
          <div class="row my-3">
            <label for="year" class="col-sm-2 col-form-label">Production year</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}"
                placeholder="Insert book's year here.">
            </div>
          </div>
          <div class="row my-3">
            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}"
                placeholder="Insert book's quantity here.">
            </div>
          </div>
          <div class="row my-3">
            <label for="category" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
              <select class="form-select" name="category" id="category">
                <option selected disabled>Choose the category for this book</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  @endif

  <div class="container rounded border">
    <table class="table-hover table align-middle">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Author</th>
          <th scope="col">Production year</th>
          <th scope="col">Quantity</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($books as $book)
          <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->year }}</td>
            <td>{{ $book->quantity }}</td>
            <td>{{ $book->category_name }}</td>

            <td class="d-flex gap-2">
              @if (Auth::user()->role()->where('role_name', 'admin')->exists())
                <a href="book/{{ $book->id }}" class="btn btn-warning">Update</a>
                <form action="book/{{ $book->id }}" method="post">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              @else
                <span class="text-muted">Read Only</span>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<x-footer />
