@extends('layouts.app')

@section('content')
<div class="container-fluid p-3">
    <!-- Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Obat Dengan Stok Menipis</li>
            </ol>
        </nav>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Info Card -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 50%; background-color: rgba(255, 193, 7, 0.1);">
                    <img src="{{ asset('assets/images/trending-down.png') }}" alt="Stok Menipis" width="28" height="28">
                </div>
                <div>
                    <h3 class="text-akan-kadaluarsa mb-0" style="font-size: 24px; font-weight: 500;">{{ $totalStokMenipis }} Obat Akan Habis</h3>
                    <p class="mb-0">Daftar obat dengan stok kurang dari 10. Harap segera lakukan pengadaan ulang.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Medications Table -->
    <div class="card">
        <div class="card-body p-3">
            <h3 class="section-title mb-3">Daftar Obat Dengan Stok Rendah (Total: {{ $totalStokMenipis }})</h3>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="table-header">
                            <th width="30%">Nama Obat</th>
                            <th width="20%" class="text-center">Batch</th>
                            <th width="20%" class="text-center">Tanggal Kadaluarsa</th>
                            <th width="15%" class="text-center">Stok</th>
                            <th width="15%" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lowStockMedications as $item)
                        <tr>
                            <td>{{ $item['nama'] }}</td>
                            <td class="text-center">{{ $item['batch'] }}</td>
                            <td class="text-center">{{ $item['tanggal_kadaluarsa'] }}</td>
                            <td class="text-center">{{ $item['stok'] }}</td>
                            <td class="text-center">
                                @if ($item['stok'] <= 0)
                                    <span class="badge bg-danger">Stok Habis</span>
                                    @elseif ($item['stok'] < 10)
                                        <span class="badge bg-warning text-dark">Hampir Habis</span>
                                        @else
                                        <span class="badge bg-success">Aman</span>
                                        @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada obat yang mendekati kehabisan stok</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-3">
                @if ($lowStockPaginator->hasPages())
                {{ $lowStockPaginator->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection