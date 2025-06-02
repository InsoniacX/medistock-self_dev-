@extends('layouts.app')

@section('content')
<div class="py-11">
    <div class="max-w-8xl mx-auto sm:px-8 lg:px-9">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Page Heading -->
                <div class="flex items-end justify-between text-center overflow-hidden h-fit mb-2">
                    <div class="flex-col w-full">
                        <h2 class="text-start font-black text-2xl pe-4 py-2">Manajemen Kasir</h2>
                        <div class="relative">
                            <input type="text" placeholder="Cari Pengguna" class="pl-10 pr-4 py-2 w-full border rounded-lg bg-white shadow" />
                            <div class="absolute top-2 left-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1 0l-5 5 1.414 1.414L10 19.414l5 5 1.414-1.414L10 18z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('register.kasir') }}" class="bg-[#279b48] rounded-2xl text-center px-4 py-2 h-fit text-white text-nowrap">+ Tambah Kasir</a>
                </div>
                <!-- Table Content -->
                <table class="w-full">
                    <thead>
                        <tr class="bg-[#279b48]">
                            <td class="rounded-s-xl px-4 font-[500] text-white py-2">Nama Kasir</td>
                            <td class="px-4 font-[500] text-white py-2">Email</td>
                            <td class="px-4 font-[500] text-white py-2">Nomor HP</td>
                            <td class="px-4 font-[500] text-white py-2">Jenis Kelamin</td>
                            <td class="rounded-e-xl px-4 font-[500] text-white py-2">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $users as $user )
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->phone_number }}</td>
                            <td class="px-4 py-2">{{ $user->gender }}</td>
                            <td class="px-4 py-2 flex gap-3">

                                <!-- Tombol Ubah -->
                                <a href="{{ route('update.kasir', $user->id) }}" class="bg-gray-500 text-white hover:text-blue-700 px-3 py-1.5 rounded-xl">Ubah</a>

                                <!-- Tombol Hapus -->
                                <a href="#" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus kasir ini?')) document.getElementById('delete-form-{{ $user->id }}').submit();" class="bg-red-500 text-white hover:text-blue-700 px-3 py-1.5 rounded-xl">Hapus</a>

                                <!-- Form untuk hapus (dikirim oleh tombol di atas) -->
                                <form id="delete-form-{{ $user->id }}"
                                    action="{{ route('delete.kasir', $user->id) }}"
                                    method="POST"
                                    class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection