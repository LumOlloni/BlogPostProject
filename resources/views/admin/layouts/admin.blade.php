<!DOCTYPE html>
<html lang="en">
<head>

  @include('admin.partials._head')
</head>
<body>
 
  @if (!Request::is('admin'))
    @include('admin.partials._navbar')
  @endif
    @yield('admin-content')
 
  @include('admin.partials._scripts')
  
  @yield('scripts')
  
</body>
</html>