<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
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
                  <button class="btn btn-danger">Delete</button>
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
