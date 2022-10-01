<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('transactions.index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group([
    'middleware'=>['auth']
], function() {
    Route::group([
        'middleware'=>['roles:superadmin']
    ], function() {
        Route::get('/transactions/create', function() {
            return view('transactions.create');
        })->name('transactions.create');
        Route::post('/transactions/store',[TransactionController::class,'store'])->name('transactions.store');
        Route::get('/transactions/{id}/edit',[TransactionController::class,'edit'])->name('transactions.edit');
        Route::put('/transactions/{id}/update',[TransactionController::class,'update'])->name('transactions.update');
        Route::delete('/transactions/{id}/delete',[TransactionController::class,'delete'])->name('transactions.delete');
    });
    Route::get('/transactions', [TransactionController::class,'index'])->name('transactions.index');
});





require __DIR__.'/auth.php';
