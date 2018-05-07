<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }} | @yield('title')</title>

<link rel="icon" type="image/png" href="{{asset("images/favicon.png")}}">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@yield('stylesheets')
