<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Pengaturan Akun
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100 p-6 gap-6">
        <!-- Main Form -->
        <main class="flex-1 bg-white p-6 rounded-xl shadow">
            @if (session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('register.kasir') }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div>
                        <label class="block font-medium">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                    </div>

                    <div>
                        <label class="block font-medium">Tanggal Lahir</label>
                        <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                    </div>

                    <div>
                        <label class="block font-medium">Jenis Kelamin</label>
                        <select name="gender" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                            <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki - laki</option>
                            <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Telepon</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                    </div>

                    <div>
                        <label class="block font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                    </div>

                    <div>
                        <label class="block font-medium">Password (Kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="w-full p-2 mt-1 bg-gray-200 rounded">
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="font-semibold mb-2">Tampilan</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block font-medium">Bahasa</label>
                            <select class="w-full p-2 bg-gray-200 rounded" disabled>
                                <option>Indonesia</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium">Ukuran Teks</label>
                            <select class="w-full p-2 bg-gray-200 rounded" disabled>
                                <option>Sedang</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium">Mode Terang</label>
                            <input type="checkbox" checked disabled class="mt-2">
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 float-right">
                    Simpan Pengaturan
                </button>
            </form>
        </main>
    </div>
</x-app-layout>