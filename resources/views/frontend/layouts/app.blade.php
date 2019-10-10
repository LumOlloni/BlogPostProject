<!DOCTYPE html>
<html lang="en">
  @include("frontend.partials._head")

  
<body class="body-log">
    @yield('stylesheet')
    @include('frontend.partials._navbar')


      @yield('content')


      @yield('scripts')

    @include('frontend.partials._footer')
    
    @include('frontend.partials._scripts')
    
</body>
</html>