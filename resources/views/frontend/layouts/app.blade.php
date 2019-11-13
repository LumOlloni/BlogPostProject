<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
  @include("frontend.partials._head")

  
<body class="body-log">
    @yield('stylesheet')
    @include('frontend.partials._navbar')

    <div id="app">
        @yield('content')
    </div>

      <script src="{{ URL::asset('js/app.js') }}"></script> 
      @yield('scripts')
   
     
    @include('frontend.partials._footer')
    
    @include('frontend.partials._scripts')
    
</body>
</html>