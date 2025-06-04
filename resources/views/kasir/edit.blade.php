<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Edit Kasir
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('update.kasir', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label value="Nama Lengkap" />
                    <x-text-input name="name" value="{{ old('name', $user->name) }}" class="w-full" required />
                </div>

                <div>
                    <x-input-label value="Email" />
                    <x-text-input name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full" required />
                </div>

                <div>
                    <x-input-label value="Nomor HP" />
                    <x-text-input name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full" required />
                </div>

                <div>
                    <x-input-label value="Jenis Kelamin" />
                    <select name="gender" class="w-full border rounded">
                        <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <x-input-label value="Tanggal Lahir" />
                    <x-text-input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}" class="w-full" required />
                </div>
            </div>

            <x-primary-button>Update Kasir</x-primary-button>
        </form>
    </div>
</x-app-layout>