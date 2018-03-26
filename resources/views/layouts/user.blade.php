<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  class="has-navbar-fixed-top">
<head>
  @include('partials._head')
  <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
  <div id="app">
    @include('partials._nav')

    <section class="section">
      <div class="container">
        @yield('main_content')
      </div>    
    </section>

  </div>

  <!-- Scripts -->
  @include('partials._scripts')

  </script>
</body>
</html>
