<!DOCTYPE html>
<html lang="en">
  @include("ViewComponents.head")
<body>

    @include('ViewComponents.navbar')

      @yield('content')


      @yield('scripts')

    @include('ViewComponents.scripts')

    

</body>
</html>