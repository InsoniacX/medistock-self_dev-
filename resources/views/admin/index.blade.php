@extends('layouts.app')

@section('content')
<div class="container-fluid p-3">
    <!-- Welcome Message -->
    <div class="mb-4">
        <p class="welcome-message">Selamat datang, {{ auth()->user()->name }} ({{ auth()->user()->getRoleNames()->first() }})</p>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
        @php
        $cards = [
        [
        'title' => 'Total Obat',
        'value' => $totalObat,
        'description' => $totalObatBaru > 0 ? $totalObatBaru . ' obat baru dalam 30 hari' : 'Tidak ada obat baru'
        ],
        [
        'title' => 'Akan Kadaluarsa',
        'value' => $akanKadaluarsa,
        'description' => 'Dalam 3 bulan'
        ],
        [
        'title' => 'Kadaluarsa',
        'value' => $kadaluarsa,
        'description' => 'Harus dimusnahkan'
        ],
        [
        'title' => 'Stok Menipis',
        'value' => $stokMenipis,
        'description' => 'Perlu pemesanan'
        ],
        ];
        @endphp

        @foreach ($cards as $card)
        <x-summary-card :title="$card['title']" :value="$card['value']" :description="$card['description']" />
        @endforeach
    </div>

    <!-- Main Content -->
    <div class="row g-3">
        <!-- Expired Reminder Table -->
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-body p-3">
                    <h3 class="section-title mb-3">Pengingat Kadaluarsa Obat</h3>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-header">
                                    <th width="20%">Nama Obat</th>
                                    <th width="15%" class="text-center">Batch</th>
                                    <th width="20%" class="text-center">Tanggal Kadaluarsa</th>
                                    <th width="15%" class="text-center">Sisa Hari</th>
                                    <th width="10%" class="text-center">Stok</th>
                                    <th width="20%" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengingatKadaluarsa as $item)
                                <x-expired-reminder-row
                                    :nama="$item['nama']"
                                    :batch="$item['batch']"
                                    :tanggalKadaluarsa="$item['tanggal_kadaluarsa']"
                                    :sisaHari="$item['sisa_hari']"
                                    :stok="$item['stok']"
                                    :status="$item['status']" />
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data pengingat kadaluarsa</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-3">
                        <div class="pagination-container">
                            @if ($pengingatKadaluarsaPaginator->hasPages())
                            <div class="pagination-info mb-2">
                                Showing {{ $pengingatKadaluarsaPaginator->firstItem() }} to {{ $pengingatKadaluarsaPaginator->lastItem() }}
                                of {{ $pengingatKadaluarsaPaginator->total() }} results
                            </div>
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($pengingatKadaluarsaPaginator->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo; Previous</span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $pengingatKadaluarsaPaginator->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
                                </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($pengingatKadaluarsaPaginator->getUrlRange(1, $pengingatKadaluarsaPaginator->lastPage()) as $page => $url)
                                @if ($page == $pengingatKadaluarsaPaginator->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                                @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($pengingatKadaluarsaPaginator->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $pengingatKadaluarsaPaginator->nextPageUrl() }}" rel="next">Next &raquo;</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next &raquo;</span>
                                </li>
                                @endif
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Notification -->
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body p-3">
                    <h3 class="section-title mb-3">Notifikasi Terbaru</h3>

                    <!-- Notifications List -->
                    <div>
                        <ul class="list-unstyled notification-list">
                            @forelse ($notifikasiTerbaru as $notif)
                            @php
                            $icon = '';
                            $iconClass = '';
                            $bgColorClass = '';

                            if (strpos($notif['pesan'], 'Telah Kadaluarsa') !== false) {
                            $icon = 'x-circle.png';
                            $iconClass = 'icon-danger';
                            $bgColorClass = 'bg-danger-light';
                            } elseif (strpos($notif['pesan'], 'Laporan') !== false) {
                            $icon = 'report.png';
                            $iconClass = 'icon-black';
                            $bgColorClass = 'bg-light-gray';
                            } elseif (strpos($notif['pesan'], 'Akan Kadaluarsa') !== false) {
                            $icon = 'alert-circle.png';
                            $iconClass = 'icon-warning';
                            $bgColorClass = 'bg-warning-light';
                            } else {
                            $icon = 'alert-circle.png';
                            $iconClass = 'icon-warning';
                            $bgColorClass = 'bg-warning-light';
                            }
                            @endphp
                            <li class="notification-item mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="notification-icon {{ $bgColorClass }}">
                                        <img src="{{ asset('assets/images/' . $icon) }}" alt="Notification Icon"
                                            width="18" height="18" class="{{ $iconClass }}">
                                    </div>
                                    <div class="ms-3">
                                        <p class="notification-message">{{ $notif['pesan'] }}</p>
                                        <p class="notification-description">{{ $notif['deskripsi'] }}</p>
                                        <span class="badge-tanggal">{{ $notif['tanggal'] }}</span>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li class="notification-item mb-3">
                                <div class="text-center">
                                    <p>Tidak ada notifikasi terbaru</p>
                                </div>
                            </li>
                            @endforelse
                        </ul>

                        <div class="text-center mt-3">
                            <a href="{{ route('notifikasi') }}" class="view-all-link">Lihat semua notifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection