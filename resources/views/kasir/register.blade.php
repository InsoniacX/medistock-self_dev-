<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Registrasi Kasir Baru
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('register.kasir') }}">
            @csrf

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label value="Nama Lengkap" />
                    <x-text-input name="name" required autofocus class="w-full" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label value="Email" />
                    <x-text-input name="email" type="email" required class="w-full" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label value="Password" />
                    <x-text-input name="password" type="password" required class="w-full" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label value="Konfirmasi Password" />
                    <x-text-input name="password_confirmation" type="password" required class="w-full" />
                </div>

                <div>
                    <x-input-label value="Nomor HP" />
                    <x-text-input name="phone_number" required class="w-full" />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>

                <div>
                    <x-input-label value="Jenis Kelamin" />
                    <select name="gender" class="w-full rounded border-gray-300">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div>
                    <x-input-label value="Tanggal Lahir" />
                    <x-text-input name="birthday" type="date" required class="w-full" />
                </div>
            </div>

            <x-primary-button>Register Kasir</x-primary-button>
        </form>
    </div>
</x-app-layout>