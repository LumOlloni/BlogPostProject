<nav class="navbar navbar-expand-lg navbar-dark bg-dark indigo">
  <a style="cursor:pointer;" id="menu-toggle" class="navbar-brand text-white">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/admin/home">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      {{-- @if (Request::is('admin/category'))
      <li class="nav-item">
          <a class="nav-link" href="/admin/category/create">Add Category</a>
        </li>
      @endif --}}
      <a href="{{ route('logout') }}" class="nav-link">Logout</a>
    </ul>
  </div>
</nav>