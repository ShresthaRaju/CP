<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  class="has-navbar-fixed-top">
<head>
  @include('partials._head')
  <link rel="stylesheet" href="{{asset('css/styles.css')}}">
  <link rel="stylesheet" href="/css/sidemenu.css">
</head>
<body>

  <div id="app">
    @include('partials.admin._nav')
    @include('partials.admin._sidemenu')

    <section class="section">
      <div id="main-content" class="container is-fluid">
        @yield('main_content')
      </div>
    </section>
  </div>


  <!-- Scripts -->
  @include('partials._scripts')
  <script type="text/javascript" src="{{asset('js/utilities/sidemenu.js')}}"></script>

</body>
</html>
