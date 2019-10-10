<nav class="navbar navbar-expand-sm bg-primary navbar-light">
    <ul class="navbar-nav">
      @auth
      <li class="nav-item">
          <a class="nav-link" href="/home"> @lang('home.home_menu')</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @lang('home.choose')
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="locale/en">@lang('home.en')</a>
          <a class="dropdown-item" href="locale/al">@lang('home.al')</a>
        </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{route('posts.index')}}">@lang('home.post_menu')</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('posts.create')}}">@lang('home.create_p')</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" >@lang('home.logout')</a>
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