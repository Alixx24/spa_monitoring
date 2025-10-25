<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'HRM Project')</title>
    
    @yield('headtag')
    
    @include('panel.layouts.head-tag') {{-- css/js اصلی --}}
</head>
<body>
    @include('panel.layouts.header') {{-- هدر سایت --}}
    
    @yield('content')
    
    {{-- اگر لازم داری jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
