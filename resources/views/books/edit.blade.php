<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <div class="container my-5">
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
          @method('PUT')
          @csrf
          <div class="row my-3">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}"
                placeholder="Insert book's title here.">
            </div>
          </div>
          <div class="row my-3">
            <label for="author" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="author" name="author" value="{{ $data->author }}"
                placeholder="Insert book's author here.">
            </div>
          </div>
          <div class="row my-3">
            <label for="year" class="col-sm-2 col-form-label">Production year</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="year" name="year" value="{{ $data->year }}"
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
  </div>
</body>

</html>
