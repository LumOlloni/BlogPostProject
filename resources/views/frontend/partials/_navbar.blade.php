<nav class="navbar navbar-expand-sm bg-primary navbar-light">
    <ul class="navbar-nav">
      @auth
      <li class="nav-item">
          <a class="nav-link" href="/home">Home</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{route('posts.index')}}">Post</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('posts.create')}}">Create Post</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" >Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </li>
      @endauth

      @guest
        <li class="nav-item active">
          <a class="nav-link" href="/">My Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
      @endguest

    </ul>
</nav>