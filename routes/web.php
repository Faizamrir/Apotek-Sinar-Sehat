<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(App\Http\Controllers\ObatController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/obat', 'index')->name('obat.index');
    Route::get('/obat/create', 'create')->name('obat.create');
    Route::post('/obat/store', 'store')->name('obat.store');
    Route::get('/obat/edit/{id}', 'edit')->name('obat.edit');
    Route::put('/obat/update/{id}', 'update')->name('obat.update');
    Route::delete('/obat/destroy/{id}', 'destroy')->name('obat.destroy');
    Route::get('/obat/show/', 'show')->name('obat.show');
});

route::controller(App\Http\Controllers\PenjualanController::class, 'index')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/penjualan', 'index')->name('penjualan.index');
    Route::post('/penjualan/store', 'store')->name('penjualan.store');
    Route::get('/penjualan/cetak-laporan/{tgl}', 'cetak_laporan')->name('penjualan.cetak-pdf');
    Route::get('/penjualan/cetak-laporan-bulanan/{bulanan}', 'cetak_laporan_bulanan')->name('penjualan.cetak-pdf-bulanan');
});

Route::controller(App\Http\Controllers\PembelianController::class, 'index')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/pembelian', 'index')->name('pembelian.index');
    Route::post('/pembelian/store', 'store')->name('pembelian.store');
    Route::get('/pembelian/cetak-laporan/{tgl}', 'cetak_laporan')->name('pembelian.cetak-pdf');
});

Route::controller(App\Http\Controllers\PemakaianController::class, 'index')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/pemakaian', 'index')->name('pemakaian.index');
    Route::get('/pemakaian/cetak-laporan/{tgl}', 'cetak_laporan')->name('pemakaian.cetak-pdf');
});

route::get('/laporan', function () {
    return view('laporan');
})->middleware(['auth', 'verified'])->name('laporan');

route::controller(App\Http\Controllers\SatuanController::class, 'index')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/satuan', 'index')->name('satuan.index');
    Route::get('/satuan/create', 'create')->name('satuan.create');
    Route::post('/satuan/store', 'store')->name('satuan.store');
    Route::get('/satuan/edit/{id}', 'edit')->name('satuan.edit');
    Route::put('/satuan/update/{id}', 'update')->name('satuan.update');
    Route::delete('/satuan/destroy/{id}', 'destroy')->name('satuan.destroy');
    Route::get('/satuan/show/{id}', 'show')->name('satuan.show');
});

Route::controller(App\Http\Controllers\SupplierController::class, 'index')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/supplier', 'index')->name('supplier.index');
    Route::post('/supplier/store', 'store')->name('supplier.store');
    Route::get('/supplier/edit/{id}', 'edit')->name('supplier.edit');
    Route::put('/supplier/update/{id}', 'update')->name('supplier.update');
    Route::delete('/supplier/destroy/{id}', 'destroy')->name('supplier.destroy');
});

Route::controller(App\Http\Controllers\FakturController::class, 'index')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/faktur', 'index')->name('faktur.index');
    Route::post('faktur/update-status', 'faktur_lunas')->name('faktur.update-status');
    Route::get('/faktur/get-faktur', 'get_faktur_all')->name('faktur.get-faktur');
    Route::get('/faktur/get-faktur-id/{id}', 'get_faktur_by_id')->name('faktur.get-faktur-id');
});

Route::controller(App\Http\Controllers\ReturnPembelianController::class, 'index')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/returnpembelian', 'index')->name('returnpembelian.index');
    Route::post('/returnpembelian/store', 'store')->name('returnpembelian.store');
});


require __DIR__.'/auth.php';
