<x-header :current-page="$currentPage" />
<div class="container my-5">
  <div class="card mb-3">
    <div class="card-header">
      Hello!
    </div>
    <div class="card-body">
      <h5 class="card-title">Edit Borrow Record</h5>

      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <ul>
              <li>{{ $error }}</li>
            </ul>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('borrow.update', $borrow->id) }}">
        @method('PUT')
        @csrf
        <div class="row my-3">
          <label for="book_id" class="col-sm-2 col-form-label">Book's Title</label>
          <div class="col-sm-10">
            <select class="form-select" name="book_id" id="book_id">
              <option value="{{ $borrow->book_id }}" selected>
                {{ $books->where('id', $borrow->book_id)->first()->title ?? 'Unknown Book' }}
              </option>
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
              <option value="{{ $borrow->user_id }}" selected>
                {{ $users->where('id', $borrow->user_id)->first()->name ?? 'Unknown Member' }}
              </option>
              @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row my-3">
          <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $borrow->quantity }}"
              placeholder="Insert book's quantity here.">
          </div>
        </div>
        <div class="row my-3">
          <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="start_date" name="start_date"
              value="{{ $borrow->start_borrow }}"
              placeholder="Insert the date of when you're going to borrow the book here.">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('borrow.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</div>
<x-footer />
