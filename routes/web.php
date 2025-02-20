<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\FollowersController;

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
Route::get('login', [SessionsController::class, 'create'])->name('user.login');
Route::post('login', [SessionsController::class, 'store'])->name('login');
Route::delete('logout', [SessionsController::class, 'destroy'])->name('logout');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/user/{id}/toggle-admin', [UsersController::class, 'toggleAdmin'])->name('user.toggleAdmin');
    Route::delete('/user/{id}', [UsersController::class, 'deleteUser'])->name('user.delete');
});
Route::get('activate/{token}', [UsersController::class, 'activateUser'])->name('user.activate');
Route::get('password/reset', [PasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('password/email', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password', [PasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');
Route::resource('statuses', StatusesController::class);
Route::get('user/{user}/followings', [UsersController::class, 'followings'])->name('users.followings');
Route::get('user/{user}/followers', [UsersController::class, 'followers'])->name('users.followers');
Route::post('user/followers/{user}', [UsersController::class, 'store'])->name('followers.store');
Route::delete('user/followers/{user}', [UsersController::class, 'destroy'])->name('followers.destroy');
