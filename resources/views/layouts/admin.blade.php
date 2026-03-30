<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex">
<!-- Top Nav (if you have one) -->
<nav class="w-full bg-gray-800 text-white p-4">
    <!-- Your top nav code goes here -->
    <a href="#" class="font-bold">My Admin Panel</a>
</nav>

<!-- Sidebar + Main Content Container -->
<div class="flex w-full">
    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-4">
        @yield('content')
    </div>
</div>
</body>
</html>
