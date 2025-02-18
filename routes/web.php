<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SessionsController;
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

Route::get('/', [StaticPagesController::class, 'home'])->name('home');
Route::get('/help', [StaticPagesController::class, 'help'])->name('help');
Route::get('/about', [StaticPagesController::class, 'about'])->name('about');
Route::get('/signup', [UsersController::class, 'create'])->name('signup');
Route::resource('users', UsersController::class);
Route::get('login', [SessionsController::class, 'create'])->name('login');
Route::post('login', [SessionsController::class, 'store'])->name('login');
Route::delete('logout', [SessionsController::class, 'destroy'])->name('logout');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/user/{id}/toggle-admin', [UsersController::class, 'toggleAdmin'])->name('user.toggleAdmin');
    Route::delete('/user/{id}', [UsersController::class, 'deleteUser'])->name('user.delete');
});
Route::get('activate/{token}', [UsersController::class, 'activateUser'])->name('user.activate');
