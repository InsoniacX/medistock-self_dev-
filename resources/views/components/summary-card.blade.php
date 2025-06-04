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

// Tentukan kelas warna berdasarkan judul
$colorClass = '';
if ($title == 'Total Obat') {
$colorClass = 'text-total-obat';
} elseif ($title == 'Akan Kadaluarsa') {
$colorClass = 'text-akan-kadaluarsa';
} elseif ($title == 'Kadaluarsa') {
$colorClass = 'text-kadaluarsa';
} elseif ($title == 'Stok Menipis') {
$colorClass = 'text-stok-menipis';
}

// Tentukan jika kartu dapat diklik
$isClickable = false;
$linkUrl = '#';
if ($title == 'Akan Kadaluarsa') {
$isClickable = true;
$linkUrl = route('expiring.medications');
} elseif ($title == 'Stok Menipis') {
$isClickable = true;
$linkUrl = route('medicines.low-stock');
}
@endphp

<div class="col-sm-6 col-lg-3">
    @if($isClickable)
    <a href="{{ $linkUrl }}" class="text-decoration-none">
        @endif
        <div class="card h-100" style="border-radius: 16px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); min-height: 150px; display: flex; flex-direction: column; justify-content: center; {{ $isClickable ? 'cursor: pointer; transition: transform 0.2s ease;' : '' }}"
            {{ $isClickable ? 'onmouseover="this.style.transform=\'scale(1.02)\'" onmouseout="this.style.transform=\'scale(1)\'"' : '' }}>
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--light-gray);">
                        <img src="{{ asset('assets/images/' . $icon) }}" alt="{{ $title }}" width="24" height="24">
                    </div>
                    <h5 class="card-title mb-0" style="font-size: 20px; font-weight: 500;">{{ $title }}</h5>
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
