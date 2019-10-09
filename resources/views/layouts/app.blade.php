<!DOCTYPE html>
<html lang="en">
  @include("viewcomponents.head")

  
<body class="body-log">
    @yield('stylesheet')
    @include('viewcomponents.navbar')


      @yield('content')


      @yield('scripts')

    @include('viewcomponents.footer')
    
    @include('viewcomponents.scripts')
    
</body>
</html>