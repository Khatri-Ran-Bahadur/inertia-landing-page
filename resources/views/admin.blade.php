<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- FontAwesome JS-->
    <script defer src="{{asset('admin/plugins/fontawesome/js/all.min.js')}}"></script>
    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{asset('admin/css/admin.css')}}">
    <link id="theme-style" rel="stylesheet" href="{{asset('admin/css/custom.css')}}">
    <!-- Scripts -->
    @routes

    <!-- Page Specific JS -->
    <script src="https://cdn.ckeditor.com/4.11.1/standard-all/ckeditor.js"></script>

    @include('ckfinder::setup')
    @vite(['resources/js/admin.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="app">
    @inertia

    <x-translations></x-translations>
    <script src="{{asset('admin/plugins/popper.min.js')}}"></script>
    <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

</body>

</html>