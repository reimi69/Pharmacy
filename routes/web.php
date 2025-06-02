<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\AdminDrugController;
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
    return view('home');
})->name('home');



Route::resource('admin/drugs', AdminDrugController::class)
    ->names('admin.drugs')
    ->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/drugs', [DrugController::class, 'index'])->name('drugs.index');
Route::get('/drugs/{drug_id}', [DrugController::class, 'show'])->name('drugs.show');
Route::get('/drugs/pharmacy/{pharmacy_id}', [PharmacyController::class, 'show'])->name('pharmacy.show');


require __DIR__.'/auth.php';
