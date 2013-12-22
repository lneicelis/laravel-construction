<!DOCTYPE html>
<html lang="en">
<head>

    @section('head-css')
        @include('public.resources.head-css')
        <link rel="stylesheet" href="{{ URL::asset('assets/public/css/svg.css') }}" rel="stylesheet" />
    @show

    @section('head-js')
        @include('public.resources.head-js')
    @show
</head>
<body>

    @yield('content')

    @section('bottom-css')
        @include('public.resources.bottom-css')
    @show

    @section('bottom-js')
        @include('public.resources.bottom-js')
    @show
</body>
</html>

