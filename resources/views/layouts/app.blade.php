<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Municipal Animal Shelter')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow mb-8">
        <div class="max-w-7xl mx-auto px-4 py-3 flex gap-6">
            <a href="{{ url('/shelter-animals') }}" class="font-medium text-gray-700 hover:text-blue-600">Animals</a>
            <a href="{{ url('/adoptions') }}" class="font-medium text-gray-700 hover:text-blue-600">Adoptions</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4">
        @yield('content')
    </main>
</body>
</html>