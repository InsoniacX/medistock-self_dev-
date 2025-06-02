<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicines;
use App\Models\Batch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class KasirController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $name = $user->name;
            $role = $user->role;

            $data = $this->kasir();
            $data['name'] = $name;
            $data['role'] = $role;

            return view('kasir.index', $data);
        }

        return redirect()->route('login');
    }

    public function kasir()
    {
        // Menghitung total obat
        $totalObat = Medicines::count();

        // Menghitung obat baru yang ditambahkan dalam 30 hari terakhir
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $totalObatBaru = Medicines::where('created_at', '>=', $thirtyDaysAgo)->count();

        // Menghitung obat yang akan kadaluarsa dalam 3 bulan
        $threeMonthsFromNow = Carbon::now()->addMonths(3);
        $akanKadaluarsa = Batch::where('expiry_date', '<=', $threeMonthsFromNow)
            ->where('expiry_date', '>', Carbon::now())
            ->count();

        // Menghitung obat yang sudah kadaluarsa
        $kadaluarsa = Batch::where('expiry_date', '<', Carbon::now())
            ->count();

        // Menghitung obat dengan stok menipis (di bawah 30)
        $stokMenipis = Batch::where('quantity', '<', 30)
            ->where('quantity', '>', 0)
            ->count();

        // get data untuk item notifikasi
        $dataNotifikasi = DB::table('batches')
            ->join('medicines', 'batches.medicine_id', '=', 'medicines.id')
            ->select(
                'medicines.name as nama',
                'batches.batch_number as batch',
                'batches.expiry_date as tanggal_kadaluarsa_raw',
                'batches.quantity as stok_raw'
            )
            ->orderBy('batches.expiry_date')
            ->limit(7)
            ->get()
            ->map(function ($item) {
                $expiryDate = Carbon::parse($item->tanggal_kadaluarsa_raw);
                $sisaHari = (int)($expiryDate->diffInDays(Carbon::now(), false) * -1);

                // Menentukan status berdasarkan tanggal kadaluarsa
                $status = 'Tersedia';
                if ($expiryDate < Carbon::now()) {
                    $status = 'Kadaluarsa';
                } elseif ($expiryDate <= Carbon::now()->addMonths(3)) {
                    $status = 'Akan Kadaluarsa';
                }

                return [
                    'nama' => $item->nama,
                    'batch' => $item->batch,
                    'tanggal_kadaluarsa' => $expiryDate->format('d M Y'),
                    'sisa_hari' => $sisaHari,
                    'stok' => $item->stok_raw . ' Tablet',
                    'status' => $status
                ];
            })
            ->toArray();

        // Membuat notifikasi berdasarkan data obat
        $notifikasiTerbaru = $this->generateNotifications($dataNotifikasi);


        // get data pengingat kadaluarsa
        $pengingatKadaluarsaQuery = DB::table('batches')
            ->join('medicines', 'batches.medicine_id', '=', 'medicines.id')
            ->select(
                'medicines.name as nama',
                'batches.batch_number as batch',
                'batches.expiry_date as tanggal_kadaluarsa_raw',
                'batches.quantity as stok_raw'
            )
            ->orderBy('batches.expiry_date');

        // Pagination dengan 10 item per halaman
        $pengingatKadaluarsaPaginated = $pengingatKadaluarsaQuery->paginate(10);

        // Transformasi data untuk tampilan
        $pengingatKadaluarsa = collect($pengingatKadaluarsaPaginated->items())->map(function ($item) {
            $expiryDate = Carbon::parse($item->tanggal_kadaluarsa_raw);
            $sisaHari = (int)($expiryDate->diffInDays(Carbon::now(), false) * -1);

            // Menentukan status berdasarkan tanggal kadaluarsa
            $status = 'Tersedia';
            if ($expiryDate < Carbon::now()) {
                $status = 'Kadaluarsa';
            } elseif ($expiryDate <= Carbon::now()->addMonths(3)) {
                $status = 'Akan Kadaluarsa';
            }

            return [
                'nama' => $item->nama,
                'batch' => $item->batch,
                'tanggal_kadaluarsa' => $expiryDate->format('d M Y'),
                'sisa_hari' => $sisaHari,
                'stok' => $item->stok_raw . ' Tablet',
                'status' => $status
            ];
        })->toArray();

        $data = [
            'totalObat' => $totalObat,
            'totalObatBaru' => $totalObatBaru,
            'akanKadaluarsa' => $akanKadaluarsa,
            'kadaluarsa' => $kadaluarsa,
            'stokMenipis' => $stokMenipis,
            'pengingatKadaluarsa' => $pengingatKadaluarsa,
            'pengingatKadaluarsaPaginator' => $pengingatKadaluarsaPaginated,
            'notifikasiTerbaru' => $notifikasiTerbaru
        ];

        return $data;
    }

    private function generateNotifications($pengingatKadaluarsa)
    {
        $notifikasi = [];
        $today = Carbon::now();

        foreach ($pengingatKadaluarsa as $item) {
            if ($item['status'] == 'Kadaluarsa') {
                // Notifikasi untuk obat kadaluarsa
                $notifikasi[] = [
                    'pesan' => $item['nama'] . ' Telah Kadaluarsa',
                    'tanggal' => $today->format('d F Y'),
                    'deskripsi' => $item['stok'] . ' perlu dilakukan pemusnahan'
                ];
            } elseif ($item['status'] == 'Akan Kadaluarsa') {
                // Notifikasi untuk obat yang akan kadaluarsa
                $notifikasi[] = [
                    'pesan' => $item['nama'] . ' Akan Kadaluarsa',
                    'tanggal' => $today->subDays(rand(1, 7))->format('d F Y'),
                    'deskripsi' => 'Dalam ' . $item['sisa_hari'] . ' hari'
                ];
                $today = Carbon::now(); // Reset tanggal
            }
        }

        // Menambahkan notifikasi laporan bulanan jika belum ada 5 notifikasi
        if (count($notifikasi) < 5) {
            $notifikasi[] = [
                'pesan' => 'Laporan Bulanan Sudah Tersedia',
                'tanggal' => Carbon::now()->startOfMonth()->format('d F Y'),
                'deskripsi' => 'Lihat ringkasan obat kadaluwarsa bulan ' . Carbon::now()->subMonth()->format('F')
            ];
        }

        // Hanya ambil 5 notifikasi terbaru
        return array_slice($notifikasi, 0, 5);
    }

    public function updateKasir(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|digits_between:10,15',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'birthday' => 'required|date|before:today',
        ]);

        $user->update($validated);

        return redirect()->route('manajemen.kasir')->with('success', 'Data kasir berhasil diperbarui.');
    }
}
