<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login {{ ucfirst($role ?? '') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="flex w-screen h-screen bg-white">
        <!-- Form Section -->
        <div class="w-1/4 flex flex-col justify-center px-20">
            <h1 class="text-4xl font-bold mb-8 text-green-600">MEDISTOCK</h1>

            @if ($errors->any())
            <div class="mb-4 text-red-500 text-sm">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" placeholder="ex: example@gmail.com" class="mt-1 p-3 border border-gray-300 rounded-md w-full" required value="{{ old('email') }}">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" placeholder="ex: Kelompok14" class="mt-1 p-3 border border-gray-300 rounded-md w-full" required>
                </div>

                <button type="submit" class="w-full bg-green-500 text-white font-semibold py-3 rounded-md hover:bg-green-600">
                    Sign In
                </button>
            </form>
        </div>

        <!-- Image Section -->
        <div class="w-3/4 bg-cover bg-center" style="background-image: url('{{ asset('images/your-image.jpg') }}');">
            <div class="flex items-center justify-center h-full bg-black bg-opacity-40">
                <div class="text-white text-center px-6">
                    <h2 class="text-2xl font-bold mb-2">Together</h2>
                    <p class="text-lg">Let's Be Healthy</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>