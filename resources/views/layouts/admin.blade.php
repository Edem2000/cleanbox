<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CleanBox Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/montserrat/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/gilroy/stylesheet.css') }}">
    @stack('styles')
    @stack('header-scripts')

</head>
<body class="relative">
@include('admin.partials.navbar')
<main>
    @yield('content')
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/admin/script.js') }}"></script>
@stack('scripts')
</body>
</html>
