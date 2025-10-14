<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ url ('public/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url ('public/frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url ('public/frontend/css/style.css') }}" />

    <title>{{ !empty($header_title) ? $header_title : '' }} - An_nur</title>
  @php
    $getHeaderSetting = App\Models\SettingModel::getSingle();
  @endphp
<link href="{{ $getHeaderSetting->getFevicon() }}" rel="icon" type="image/jpg" />
  </head>
  <body>
    <body id="top">
        <div class="whole-container">
         @include('admin.frontend.layouts.header')
    </div>

    @yield('content')
    
   @include('admin.frontend.layouts.footer') 
<script src="{{ url ('public/frontend/JS/script.js') }}"></script>
<script src="{{ url ('public/frontend/JS/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>
