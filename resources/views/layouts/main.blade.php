<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  class="has-navbar-fixed-top">
<head>
  @include('partials._head')
</head>
<body>
  <div id="app">
    @include('partials._nav')

    <main class="py-4 m-t-75">
        @yield('main_content')
    </main>
  </div>

  <!-- Scripts -->
  @include('partials._scripts')

</body>
</html>
