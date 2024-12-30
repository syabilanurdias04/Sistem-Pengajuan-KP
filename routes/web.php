<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\JadwalPengajuanController;
use App\Http\Controllers\AdminController;

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('proposal', ProposalController::class);
Route::resource('jadwal', JadwalPengajuanController::class);


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/mahasiswa', [AdminController::class, 'createMahasiswa'])->name('admin.createMahasiswa');
    Route::post('/admin/jadwal', [AdminController::class, 'createJadwal'])->name('admin.createJadwal');
    
// Rute lain untuk edit, update, delete
Route::get('/settings', [SettingsController::class, 'index'])->middleware('role:admin')->name('settings.index');
Route::post('/settings', [SettingsController::class, 'update'])->middleware('role:admin')->name('settings.update');
});
Route::get('/audit-logs', [AuditLogController::class, 'index'])->middleware('role:admin')->name('audit.logs');
require __DIR__.'/auth.php';
