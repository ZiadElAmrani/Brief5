<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\todos_Controller;
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

Route::get('/', [todos_Controller::class, "todoIndex"]);
Route::post('/todoInsert', [todos_Controller::class, "todoInsert"]);



//DASHBOARD AND AUTHENTIFICATION ROUTES//

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//OAuthentification ROUTES

require __DIR__.'/auth.php';

Route::get('/login/google', [Controller::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [Controller::class, 'handleCallBack']);