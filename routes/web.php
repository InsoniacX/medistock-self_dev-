<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnalysticsController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;

Route::get('/login', function () {
    return view('auth.role-selector');
})->name('login');

// Route for Admin Login
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login');

// Route for Kasir Login
Route::get('/kasir/login', [AuthController::class, 'showKasirLogin'])->name('kasir.auth.login');
Route::post('/kasir/login', [AuthController::class, 'login'])->name('kasir.login');

// Route for Authenticated Users
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    Route::get('/kasir-dashboard', [AuthController::class, 'kasirDashboard'])->name('kasir.dashboard');

    Route::get('/expiring-medications', [App\Http\Controllers\DashboardController::class, 'expiringMedications'])->name('expiring.medications');

    Route::get('/manajemen-kasir', function () {
        return view('admin.manajemenkasir');
    })->name('manajemen.kasir');

    Route::get('/manajemen-kasir', [DashboardController::class, 'showManajemenKasir'])->name('manajemen.kasir');

    Route::get('/register-kasir', [DashboardController::class, 'showRegisterKasir'])->name('register.kasir');

    Route::post('/register-kasir', [DashboardController::class, 'registerKasir'])->name('store.kasir');

    Route::get('/update-kasir/{id}', [DashboardController::class, 'showUpdateKasir'])->name('update.kasir');

    Route::put('/update-kasir/{id}', [DashboardController::class, 'updateKasir'])->name('update.kasir');

    Route::delete('/delete-kasir/{id}', [DashboardController::class, 'deleteKasir'])->name('delete.kasir');
});



Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Route Untuk Medicine
Route::get('/medicines', [MedicineController::class, 'index']);

// Route untuk halaman Report
Route::get('reports/weekly/export', [ReportController::class, 'exportWeekly'])->name('reports.weekly.export');
Route::get('reports/monthly/export', [ReportController::class, 'exportMonthly'])->name('reports.monthly.export');
Route::get('reports/annual/export', [ReportController::class, 'exportAnnual'])->name('reports.annual.export');

Route::get('/analytics', [AnalysticsController::class, 'index'])->name('analytics.index');
Route::get('/analytics/trend/{range}', [AnalysticsController::class, 'getTrend']);

Route::prefix('reports')->group(function () {
    Route::get('/weekly', [ReportController::class, 'weekly'])->name('reports.weekly');
    Route::get('/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/annual', [ReportController::class, 'annual'])->name('reports.annual');
});

// Route for Notification
Route::get('/notify', [NotificationController::class, 'index']);

// Route untuk halaman inventaris
Route::get('/inventory', [MedicineController::class, 'index'])->name('inventory.index');
Route::get('/inventory/create', [MedicineController::class, 'create'])->name('inventory.create');
Route::post('/inventory', [MedicineController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{medicine}/edit', [MedicineController::class, 'edit'])->name('inventory.edit');
Route::put('/inventory/{medicine}', [MedicineController::class, 'update'])->name('inventory.update');
Route::delete('/inventory/{medicine}', [MedicineController::class, 'destroy'])->name('inventory.destroy');

Route::get('/expiring-medications', [App\Http\Controllers\DashboardController::class, 'expiringMedications'])
    ->name('expiring.medications');

//notifikasi
Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi');
Route::get('/produkkadaluarsa', [NotificationController::class, 'index'])->name('produkkadaluarsa');
Route::get('/produkhabis', [NotificationController::class, 'index'])->name('produkhabis');
Route::get('/laporanbulanan', [NotificationController::class, 'index'])->name('laporanbulanan');

// Route for low stock medications
Route::get('/low-stock', [MedicineController::class, 'lowStock'])->name('medicines.low-stock');
