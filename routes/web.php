<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EstimatorController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Public Portfolio Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Panel Routes (Protected by Auth)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('team', TeamController::class)->except(['show']);

    // Gallery
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Contacts
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::patch('contacts/{contact}/read', [ContactController::class, 'markAsRead'])->name('contacts.read');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    // Estimator Harga (Simulasi Beli Putus vs Sewa)
    Route::get('estimator', [EstimatorController::class, 'index'])->name('estimator.index');

    // Generator Kontrak PDF (tanpa penyimpanan database)
    Route::get('contracts/create', [ContractController::class, 'create'])->name('contracts.create');
    Route::post('contracts/generate', [ContractController::class, 'generate'])->name('contracts.generate');

    // Profil Admin & Ubah Password
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
