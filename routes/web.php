<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\ComproController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\Eproc\BeritaController;
use App\Http\Controllers\JajaranDireksiController;
use App\Http\Controllers\JajaranKomisarisController;
use App\Http\Controllers\ProfilePerusahaanController;
use App\Http\Controllers\Eproc\AkunController as EprocAkunController;
use App\Http\Controllers\BarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('eproc')->name('eproc.')->group(function(){
  Route::middleware(['web'])->group(function(){
    Route::get('/login', [Controller::class, 'login'])->name('login');
    Route::post('/postlogin', [Controller::class, 'postlogin'])->name('postlogin');
    Route::get('/logout', [Controller::class, 'logout'])->name('logout');
  });

  Route::prefix('superadmin')->name('superadmin.')->group(function(){
    Route::middleware(['auth:web', 'superadmin', 'disable_back_button'])->group(function(){
      Route::get('/dashboard', function(){return view('pages.eproc.superadmin.dashboard');})->name('dashboard');
      Route::resource('akun', EprocAkunController::class);
      Route::resource('berita', BeritaController::class);
      Route::get('export-berita', [BeritaController::class, 'export_berita'])->name('export-berita');
      Route::post('import-berita', [BeritaController::class, 'import_berita'])->name('import-berita');
      Route::get('cetak-pdf', [BeritaController::class, 'cetak_pdf'])->name('cetak-pdf');
      Route::get('profile', [Controller::class, 'profile'])->name('profile');
      Route::put('postprofile', [Controller::class, 'postprofile'])->name('postprofile');
      Route::resource('barang', BarangController::class);
    });
  });

  Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['auth:web', 'admin', 'disable_back_button'])->group(function(){
      Route::get('/dashboard', function(){return view('pages.eproc.admin.dashboard');})->name('dashboard');
      Route::resource('berita', BeritaController::class);
      Route::get('export-berita', [BeritaController::class, 'export_berita'])->name('export-berita');
      Route::post('import-berita', [BeritaController::class, 'import_berita'])->name('import-berita');
      Route::get('cetak-pdf', [BeritaController::class, 'cetak_pdf'])->name('cetak-pdf');
      Route::get('profile', [Controller::class, 'profile'])->name('profile');
      Route::put('postprofile', [Controller::class, 'postprofile'])->name('postprofile');
      Route::resource('barang', BarangController::class);
    });
  });
});

Route::prefix('compro')->name('compro.')->group(function(){
  Route::middleware(['web'])->group(function(){
    Route::get('/login', [ComproController::class, 'login'])->name('login');
    Route::post('/postlogin', [ComproController::class, 'postlogin'])->name('postlogin');
    Route::get('/register', [ComproController::class, 'register'])->name('register');
    Route::post('/postregister', [ComproController::class, 'postregister'])->name('postregister');
    Route::get('/logout', [ComproController::class, 'logout'])->name('logout');
  });

  Route::prefix('superadmin')->name('superadmin.')->group(function(){
      Route::middleware(['auth:web', 'superadmin', 'disable_back_button'])->group(function(){
        Route::get('/dashboard', function(){return view('pages.compro.superadmin.dashboard');})->name('dashboard');
        Route::resource('akun', AkunController::class);
        Route::get('profile-perusahaan', [ProfilePerusahaanController::class, 'index'])->name('profile-perusahaan');
        Route::get('profile-perusahaan/{id}/edit', [ProfilePerusahaanController::class, 'edit'])->name('profile-perusahaan.edit');
        Route::put('profile-perusahaan/{id}', [ProfilePerusahaanController::class, 'update'])->name('profile-perusahaan.update');
        Route::resource('portofolio', PortofolioController::class);
        Route::resource('artikel', ArtikelController::class);
        Route::resource('jajaran-direksi', JajaranDireksiController::class);
        Route::resource('jajaran-komisaris', JajaranKomisarisController::class);
        Route::get('survey', [SurveyController::class, 'index'])->name('survey');
        Route::get('survey/{id}', [SurveyController::class, 'show'])->name('survey.show');
        Route::get('export-artikel', [ArtikelController::class, 'export_artikel'])->name('export-artikel');
        Route::post('import-artikel', [ArtikelController::class, 'import_artikel'])->name('import-artikel');
        Route::get('cetak-pdf', [ArtikelController::class, 'cetak_pdf'])->name('cetak-pdf');
        Route::get('profile', [Controller::class, 'profile'])->name('profile');
        Route::put('postprofile', [Controller::class, 'postprofile'])->name('postprofile');
      });
  });

  Route::prefix('admin')->name('admin.')->group(function(){
      Route::middleware(['auth:web', 'admin', 'disable_back_button'])->group(function(){
        Route::get('/dashboard', function(){return view('pages.compro.admin.dashboard');})->name('dashboard');
        Route::get('profile-perusahaan', [ProfilePerusahaanController::class, 'index'])->name('profile-perusahaan');
        Route::get('profile-perusahaan/{id}/edit', [ProfilePerusahaanController::class, 'edit'])->name('profile-perusahaan.edit');
        Route::put('profile-perusahaan/{id}', [ProfilePerusahaanController::class, 'update'])->name('profile-perusahaan.update');
        Route::resource('portofolio', PortofolioController::class);
        Route::resource('artikel', ArtikelController::class);
        Route::resource('jajaran-direksi', JajaranDireksiController::class);
        Route::resource('jajaran-komisaris', JajaranKomisarisController::class);
        Route::get('survey', [SurveyController::class, 'index'])->name('survey');
        Route::get('survey/{id}', [SurveyController::class, 'show'])->name('survey.show');
        Route::get('export-artikel', [ArtikelController::class, 'export_artikel'])->name('export-artikel');
        Route::post('import-artikel', [ArtikelController::class, 'import_artikel'])->name('import-artikel');
        Route::get('cetak-pdf', [ArtikelController::class, 'cetak_pdf'])->name('cetak-pdf');
        Route::get('profile', [Controller::class, 'profile'])->name('profile');
        Route::put('postprofile', [Controller::class, 'postprofile'])->name('postprofile');
      });
  });

  Route::prefix('creator')->name('creator.')->group(function(){
      Route::middleware(['auth:web', 'creator', 'disable_back_button'])->group(function(){
        Route::get('/dashboard', function(){return view('pages.compro.creator.dashboard');})->name('dashboard');
        Route::resource('artikel', ArtikelController::class);
        Route::get('export-artikel', [ArtikelController::class, 'export_artikel'])->name('export-artikel');
        Route::post('import-artikel', [ArtikelController::class, 'import_artikel'])->name('import-artikel');
        Route::get('cetak-pdf', [ArtikelController::class, 'cetak_pdf'])->name('cetak-pdf');
        Route::get('profile', [Controller::class, 'profile'])->name('profile');
        Route::put('postprofile', [Controller::class, 'postprofile'])->name('postprofile');
      });
  });

  Route::prefix('helpdesk')->name('helpdesk.')->group(function(){
      Route::middleware(['auth:web', 'helpdesk', 'disable_back_button'])->group(function(){
        Route::get('/dashboard', function(){return view('pages.compro.helpdesk.dashboard');})->name('dashboard');
        Route::get('survey', [SurveyController::class, 'index'])->name('survey');
        Route::get('survey/{id}', [SurveyController::class, 'show'])->name('survey.show');
        Route::get('profile', [Controller::class, 'profile'])->name('profile');
        Route::put('postprofile', [Controller::class, 'postprofile'])->name('postprofile');
      });
  });
});