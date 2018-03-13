<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  class="has-navbar-fixed-top">
<head>
  @include('partials._head')
</head>
<body>
  <div id="app">
    @include('partials._nav')

    @yield('main_content')
    
  </div>

  <!-- Scripts -->
  @include('partials._scripts')

  </script>
</body>
</html>
