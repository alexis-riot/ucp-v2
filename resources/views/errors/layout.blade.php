<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Mafia City RP - UCP') }} - @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="{{ asset('css/pages/error/error.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('images/logos/favicon-mcrp.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/logos/favicon-mcrp.png') }}" />
 </head>

  <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-error-v4" style="background-image: url(@yield('image'));">
        <div class="kt-error_container">
          <h1 class="kt-error_number">
            @yield('code')
          </h1>
          <p class="kt-error_title">
            @yield('code-string')
          </p>
          <p class="kt-error_description">
            @yield('message')
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
