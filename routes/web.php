<?php

use App\Livewire\Portal\Auth\Login;
use App\Livewire\Portal\ComplaintForm;
use App\Livewire\Portal\FaqPage;
use App\Livewire\Portal\Home;
use App\Livewire\Portal\ServiceCatalog;
use App\Livewire\Portal\ServiceDetail;
use App\Livewire\Portal\ServiceRequest\DtsenForm;
use App\Livewire\Portal\ServiceRequest\PbiForm;
use App\Livewire\Portal\TrackTicket;
use App\Livewire\Portal\VerifyCertificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Portal Publik SAPA SOSIAL
Route::get('/', Home::class)->name('home');
Route::get('/layanan', ServiceCatalog::class)->name('services.catalog');
Route::get('/layanan/{slug}', ServiceDetail::class)->name('services.detail');
Route::get('/pengajuan/dtsen', DtsenForm::class)->name('service-request.dtsen');
Route::get('/pengajuan/pbi', PbiForm::class)->name('service-request.pbi');
Route::get('/cek-status', TrackTicket::class)->name('track-ticket');
Route::get('/pengaduan', ComplaintForm::class)->name('complaint.create');
Route::get('/verifikasi', VerifyCertificate::class)->name('certificate.verify');
Route::get('/faq', FaqPage::class)->name('faq');

// Autentikasi Warga
Route::get('/login', Login::class)->name('login');
Route::get('/register', Login::class)->name('register');
Route::match(['get', 'post'], '/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');
