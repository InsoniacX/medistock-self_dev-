<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Registrasi Kasir Baru
        </h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('store.kasir') }}">
            @csrf

            <div class="grid grid-cols-2 gap-4 mb-8">
                <div>
                    <label class="block font-medium">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                </div>

                <div>
                    <label class="block font-medium">Tanggal Lahir</label>
                    <input type="date" name="birthday" value="{{ old('birthday') }}" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                </div>

                <div>
                    <label class="block font-medium">Jenis Kelamin</label>
                    <select name="gender" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block font-medium">Telepon</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                </div>

                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                </div>

                <div>
                    <label class="block font-medium">Password</label>
                    <input type="password" name="password" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                </div>

                <div>
                    <label class="block font-medium">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                </div>
            </div>

            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 float-right">
                Simpan Registrasi
            </button>
        </form>
    </div>
</x-app-layout>