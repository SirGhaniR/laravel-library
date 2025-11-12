<x-header />
<div class="container my-5">
  <div class="card mb-3">
    <div class="card-header">
      Hello!
    </div>
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h5 class="card-title">Add new category</h5>
        <a href="/category">Back to categories</a>
      </div>

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
          <label for="category" class="col-sm-2 col-form-label">Category</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="category" name="category_name"
              value="{{ $data->category_name }}">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
<x-footer />
