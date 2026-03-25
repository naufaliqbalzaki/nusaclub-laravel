<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CoachController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MonthlyBillController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PublicTestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/daftar', [PendaftaranController::class, 'create'])->name('daftar');
Route::post('/daftar', [PendaftaranController::class, 'store'])->name('daftar.store');

Route::post('/testimoni', [PublicTestimonialController::class, 'store'])->name('testimonials.public.store');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/pendaftarans', [AdminPendaftaranController::class, 'index'])->name('pendaftarans.index');
        Route::get('/pendaftarans/export', [AdminPendaftaranController::class, 'export'])->name('pendaftarans.export');
        Route::patch('/pendaftarans/{pendaftaran}/status', [AdminPendaftaranController::class, 'updateStatus'])->name('pendaftarans.update-status');
        Route::post('/pendaftarans/{pendaftaran}/convert', [AdminPendaftaranController::class, 'convertToStudent'])->name('pendaftarans.convert');

        Route::resource('programs', ProgramController::class);
        Route::resource('packages', PackageController::class);
        Route::resource('locations', LocationController::class);
        Route::resource('students', StudentController::class);

        Route::get('/bills', [MonthlyBillController::class, 'index'])->name('bills.index');
        Route::get('/bills/create', [MonthlyBillController::class, 'create'])->name('bills.create');
        Route::post('/bills', [MonthlyBillController::class, 'store'])->name('bills.store');
        Route::get('/bills/{monthlyBill}/edit', [MonthlyBillController::class, 'edit'])->name('bills.edit');
        Route::put('/bills/{monthlyBill}', [MonthlyBillController::class, 'update'])->name('bills.update');
        Route::delete('/bills/{monthlyBill}', [MonthlyBillController::class, 'destroy'])->name('bills.destroy');
        Route::post('/bills/generate', [MonthlyBillController::class, 'generate'])->name('bills.generate');

        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/export', [PaymentController::class, 'export'])->name('payments.export');
        Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

        Route::patch('/testimonials/{testimonial}/status', [TestimonialController::class, 'updateStatus'])->name('testimonials.update-status');
        Route::resource('testimonials', TestimonialController::class);

        Route::resource('faqs', FaqController::class);
        Route::resource('coaches', CoachController::class);

        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    });