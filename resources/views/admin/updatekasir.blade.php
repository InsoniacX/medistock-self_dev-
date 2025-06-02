@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r p-6 flex flex-col justify-between">
        <div class="text-center">
            <div class="mx-auto w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-5xl">
                👤
            </div>
            <h2 class="mt-2 font-bold text-xl">{{ $user->name }}</h2>
        </div>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-8">
        <form method="POST" action="{{ route('update.kasir', $user->id ) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-6 mb-6">
                <!-- Nama -->
                <div>
                    <label class="block font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" value="{{ $user->name }}" class="w-full p-2 bg-gray-200 rounded">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block font-semibold mb-1">Tanggal Lahir</label>
                    @php
                    $birthday = \Carbon\Carbon::parse($user->birthday);
                    @endphp
                    <div class="flex gap-2">
                        <select class="p-2 bg-gray-200 rounded" disabled>
                            <option selected>{{ $birthday->format('d') }}</option>
                        </select>
                        <select class="p-2 bg-gray-200 rounded">
                            <option selected>{{ $birthday->translatedFormat('F') }}</option>
                        </select>
                        <select class="p-2 bg-gray-200 rounded">
                            <option selected>{{ $birthday->format('Y') }}</option>
                        </select>
                    </div>
                </div>

                <!-- Gender -->
                <div>
                    <label class="block font-semibold mb-1">Jenis kelamin</label>
                    <select class="w-full p-2 bg-gray-200 rounded">
                        <option selected>{{ $user->gender }}</option>
                    </select>
                </div>

                <!-- Phone -->
                <div>
                    <label class="block font-semibold mb-1">Telepon</label>
                    <input type="text" value="{{ $user->phone_number }}" class="w-full p-2 bg-gray-200 rounded">
                </div>

                <!-- Email -->
                <div>
                    <label class="block font-semibold mb-1">Email</label>
                    <input type="email" value="{{ $user->email }}" class="w-full p-2 bg-gray-200 rounded">
                </div>

                <!-- Password -->
                <div>
                    <label class="block font-semibold mb-1">Password</label>
                    <input type="password" value="********" class="w-full p-2 bg-gray-200 rounded">
                </div>
            </div>
        </form>
    </main>
</div>
@endsection