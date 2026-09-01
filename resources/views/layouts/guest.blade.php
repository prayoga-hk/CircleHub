<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CircleHub - Register</title>

        <!-- Fonts & Tailwind CDN -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased bg-[#0B101D] text-white min-h-screen flex items-center justify-center p-0 md:p-6">
        <!-- Mengeluarkan slot konten register tanpa dibungkus box putih bawaan -->
        {{ $slot }}
    </body>
</html>