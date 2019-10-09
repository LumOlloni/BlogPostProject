<nav class="navbar navbar-expand-lg navbar-dark bg-dark indigo">
  <a class="navbar-brand" href="/admin/home">Admin</a>
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
      <li class="nav-item">
        <a class="nav-link" href="/admin/approve">Aprove Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Aprove Comment</a>
      </li>
      <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();" >Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
    </ul>
  </div>
</nav>