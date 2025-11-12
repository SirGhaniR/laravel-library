<x-header />
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
            <input type="text" class="form-control" id="title" name="title" value="{{ $books->title }}"
              placeholder="Insert book's title here.">
          </div>
        </div>
        <div class="row my-3">
          <label for="author" class="col-sm-2 col-form-label">Author</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="author" name="author" value="{{ $books->author }}"
              placeholder="Insert book's author here.">
          </div>
        </div>
        <div class="row my-3">
          <label for="year" class="col-sm-2 col-form-label">Production year</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="year" name="year" value="{{ $books->year }}"
              placeholder="Insert book's year here.">
          </div>
        </div>
        <div class="row my-3">
          <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $books->quantity }}"
              placeholder="Insert book's quantity here.">
          </div>
        </div>
        <div class="row my-3">
          <label for="category" class="col-sm-2 col-form-label">Category</label>
          <div class="col-sm-10">
            <select class="form-select" name="category" id="category">
              <option value="{{ $books->category_id }}" selected>{{ $books->category_name }}</option>
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
<x-footer />
