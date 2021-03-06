<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <title>{{ config('app.name', 'Mafia City RP - UCP') }}</title>
  <meta name="description" content="Login page example">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!--begin::Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

  <!--end::Fonts -->

  <!--begin::Page Custom Styles(used by this page) -->
  <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

  <link rel="shortcut icon" href="{{ asset('images/logos/favicon-mcrp.png') }}" />
  <link rel="apple-touch-icon" href="{{ asset('images/logos/favicon-mcrp.png') }}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
  <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{ asset('images/bg/bg-gta5-4.jpg') }}); background-repeat: no-repeat;">
      <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
        <div class="kt-login__container">
          <div class="kt-login__logo">
            <a href="#">
              <img src="{{ asset('images/logos/logo-mcrp-new.png') }}">
            </a>
          </div>

          @yield('content')

        </div>
      </div>
    </div>
  </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#2c77f4",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>
<script src="{{ asset('js/global.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/scripts.js') }}" type="text/javascript"></script>

</body>

<!-- end::Body -->
</html>
