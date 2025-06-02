<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Batch;
use Illuminate\Support\Facades\Route;

class NotificationController extends Controller
{
    public function index()
    {
        $route = Route::currentRouteName(); // Menentukan route yang diakses

        $today = Carbon::today();
        $nextMonth = $today->copy()->addMonth();

        // Ambil semua data
        $expiredBatches = Batch::with('medicine')
            ->where('expiry_date', '<', $today)
            ->get();

        $nearExpiredBatches = Batch::with('medicine')
            ->whereBetween('expiry_date', [$today, $nextMonth])
            ->get();

        $emptyBatches = Batch::with('medicine')
            ->where('quantity', '<=', 0)
            ->get();

        if ($route === 'produkkadaluarsa') {
            return view('produkkadaluarsa', [
                'expiredBatches' => $expiredBatches,
            ]);
        } elseif ($route === 'produkhabis') {
            return view('produkhabis', [
                'emptyBatches' => $emptyBatches,
            ]);
        } else { // 'notifikasi'
            return view('notifikasi', [
                'expiredBatches' => $expiredBatches,
                'nearExpiredBatches' => $nearExpiredBatches,
                'emptyBatches' => $emptyBatches,
            ]);
        }

        return 'Notification page';
    }
}
