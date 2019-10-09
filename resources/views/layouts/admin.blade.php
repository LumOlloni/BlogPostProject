<!DOCTYPE html>
<html lang="en">
<head>

  @include('adminviewcomponents.head')
</head>
<body>
 
  @if (!Request::is('admin'))
    @include('adminviewcomponents.navbar')
  @endif
    @yield('admin-content')
 
  @include('adminviewcomponents.scripts')
  
  @yield('scripts')
  
</body>
</html>