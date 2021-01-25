<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('admin.title', 'Laravel') }}</title>
    <!--Fonts-->
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">--}}
    <!--Styles-->
    <!--Fontawesome-->
    <link rel="stylesheet" href="{{ asset('vendor/laravel-vue-admin/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!--AdminLte-->
    <link rel="stylesheet" href="{{ asset('vendor/laravel-vue-admin/admin-lte/dist/css/adminlte.min.css') }}">
    <!--LaravelVueAdmin-->
    <link rel="stylesheet" href="{{ asset('vendor/laravel-vue-admin/css/app.css') }}">
</head>
<body class="hold-transition">
{{--<body class="hold-transition @if(request()->route()->action['as'] === 'admin.login') login-page @else {{ config('admin.theme.layout') }} {{ config('admin.theme.accent') }} @endif">--}}
@inertia
<!--Scripts-->
<!--Jquery-->
<script src="{{ asset('vendor/laravel-vue-admin/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
<!--Bootstrap4-->
<script src="{{ asset('vendor/laravel-vue-admin/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!--AdminLte-->
<script src="{{ asset('vendor/laravel-vue-admin/admin-lte/dist/js/adminlte.min.js') }}"></script>
<!--LaravelVueAdmin-->
<script src="{{ asset('vendor/laravel-vue-admin/js/app.js') }}"></script>
</body>
</html>
