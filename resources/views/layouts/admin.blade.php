<!DOCTYPE html>
<html lang="en">
<head>

  @include('adminviewcomponents.head')
</head>
<body>
  @yield('admin-content')

  @yield('scripts')
  
  @include('adminviewcomponents.scripts')
</body>
</html>