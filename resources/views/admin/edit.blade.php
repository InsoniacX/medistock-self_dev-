@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex">
    <!-- Main Content -->
    <main class="flex-1 p-10">
        <form action="{{ route('kasir.update.profile') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div>
                    <label class="block font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 border rounded">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block font-semibold mb-1">Tanggal Lahir</label>
                    <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}" class="w-full p-2 border rounded">
                </div>

                <!-- Gender -->
                <div>
                    <label class="block font-semibold mb-1">Jenis Kelamin</label>
                    <select name="gender" class="w-full p-2 border rounded">
                        <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Telepon -->
                <div>
                    <label class="block font-semibold mb-1">Telepon</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full p-2 border rounded">
                </div>

                <!-- Email -->
                <div>
                    <label class="block font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-2 border rounded">
                </div>

                <!-- Password -->
                <div>
                    <label class="block font-semibold mb-1">Password (opsional)</label>
                    <input type="password" name="password" class="w-full p-2 border rounded" placeholder="Kosongkan jika tidak ingin ganti">
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="text-right">
                <button type="submit" class="bg-red-600 text-white font-bold px-6 py-2 rounded-full hover:bg-red-700">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </main>
</div>
@endsection