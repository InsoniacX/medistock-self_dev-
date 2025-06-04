<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Profil Saya
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100 p-6 gap-6">
        <!-- Form -->
        <main class="flex-1 bg-white p-6 rounded-xl shadow">
            @if (session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('update.kasir', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block font-medium">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                    </div>

                    <div>
                        <label class="block font-medium">Tanggal Lahir</label>
                        <div class="flex gap-2">
                            <select name="birth_day" class="p-2 bg-gray-200 rounded" required>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ \Carbon\Carbon::parse($user->birthday)->day == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                            </select>

                            <select name="birth_month" class="p-2 bg-gray-200 rounded" required>
                                @foreach ([
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ] as $num => $month)
                                <option value="{{ $num }}" {{ \Carbon\Carbon::parse($user->birthday)->month == $num ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>

                            <select name="birth_year" class="p-2 bg-gray-200 rounded" required>
                                @for ($y = date('Y'); $y >= 1950; $y--)
                                <option value="{{ $y }}" {{ \Carbon\Carbon::parse($user->birthday)->year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium">Jenis Kelamin</label>
                        <select name="gender" class="w-full p-2 mt-1 bg-gray-200 rounded" required>
                            <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
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
                        <label class="block font-medium">Password (opsional)</label>
                        <input type="password" name="password" class="w-full p-2 mt-1 bg-gray-200 rounded">
                    </div>
                </div>

                <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 float-right">
                    Simpan Data Kasir
                </button>
            </form>
        </main>
    </div>
</x-app-layout>