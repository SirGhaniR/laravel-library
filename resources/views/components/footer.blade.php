  {{-- <footer class="my-4 py-3">
    <ul class="nav col-12 col-md-auto justify-content-center mb-md-0 mb-2">
      <li><a href="{{ $currentPage != 'home' ? url('/') : '#' }}" class="nav-link px-2">Home</a></li>
      @auth
        @if (Auth::user()->role()->where('role_name', 'member')->exists())
          <li><a href="{{ $currentPage != 'home' ? url('member/books') : url('book') }}" class="nav-link px-2">Books</a>
          </li>
          <li><a href="{{ $currentPage != 'home' ? url('member/categories') : url('category') }}"
              class="nav-link px-2">Categories</a></li>
          <li><a href="{{ $currentPage != 'home' ? url('member/borrows') : url('borrow') }}"
              class="nav-link px-2">Borrows</a>
          </li>
        @else
          <li><a href="{{ $currentPage != 'home' ? url('admin/book') : url('book') }}" class="nav-link px-2">Books</a>
          </li>
          <li><a href="{{ $currentPage != 'home' ? url('admin/category') : url('category') }}"
              class="nav-link px-2">Categories</a></li>
          <li><a href="{{ $currentPage != 'home' ? url('admin/borrow') : url('borrow') }}"
              class="nav-link px-2">Borrows</a>
          </li>
        @endif
      @else
        <li><a href="{{ $currentPage != 'home' ? url('admin/book') : url('book') }}" class="nav-link px-2">Books</a></li>
        <li><a href="{{ $currentPage != 'home' ? url('admin/category') : url('category') }}"
            class="nav-link px-2">Categories</a></li>
        <li><a href="{{ $currentPage != 'home' ? url('admin/borrow') : url('borrow') }}" class="nav-link px-2">Borrows</a>
        </li>
      @endauth
    </ul>
    <p class="text-body-secondary text-center">Copyright &copy; Laravel Library All Rights Reserved.</p>
  </footer> --}}
  </body>

  </html>
