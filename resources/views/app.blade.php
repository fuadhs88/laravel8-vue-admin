<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('admin.title', 'Laravel') }}</title>
    <!--Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!--Styles-->
    <link rel="stylesheet" href="{{ asset('vendor/laravel-admin/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laravel-admin/admin-lte/dist/css/adminlte.min.css') }}">
    <!--AppStyles-->
    <link rel="stylesheet" href="{{ asset('vendor/laravel-admin/laravel-admin/css/app.css') }}">
    @routes
</head>
<body class="hold-transition login-page">
@inertia
<!--Scripts-->
<script src="{{ asset('vendor/laravel-admin/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-admin/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-admin/admin-lte/dist/js/adminlte.min.js') }}"></script>
<!--AppScripts-->
<script src="{{ asset('vendor/laravel-admin/laravel-admin/js/app.js') }}"></script>
</body>
</html>
