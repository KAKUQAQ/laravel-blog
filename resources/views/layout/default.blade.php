<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('layout._header')
<div class="container">
    @include('shared._message')
    @yield('content')
</div>
@include('layout._footer')
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
