<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen flex flex-col justify-center items-center bg-green-600 text-white">
        <!-- Logo atau Avatar -->
        <div class="text-center mb-10">
            <div class="w-40 h-40 bg-white rounded-full flex items-center justify-center text-5xl mx-auto">
                🏥
            </div>
            <h1 class="text-3xl font-bold mt-6">Masuk Sebagai</h1>
        </div>

        <!-- Pilihan Role -->
        <div class="flex space-x-8">
            <a href="{{ route('admin.login') }}"
                class="text-lg px-6 py-3 border border-white rounded-lg hover:bg-white hover:text-green-600 transition font-semibold">
                Admin
            </a>
            <a href="{{ route('kasir.login') }}"
                class="text-lg px-6 py-3 border border-white rounded-lg hover:bg-white hover:text-green-600 transition font-semibold">
                Kasir
            </a>
        </div>
    </div>
</body>

</html>