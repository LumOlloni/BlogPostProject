<!DOCTYPE html>
<html lang="en">
  @include("viewcomponents.head")
<body>

    @include('viewcomponents.navbar')

      @yield('content')


      @yield('scripts')

    @include('viewcomponents.scripts')

    

</body>
</html>