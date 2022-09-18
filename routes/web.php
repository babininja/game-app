<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\User\AuthController;
use \App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\User\GameController;
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
    return view('welcome');
})->name('home');
Route::get('management/login', [AdminAuthController::class, 'index']);
Route::post('management/login', [AdminAuthController::class, 'login'])->name('management.login');
Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'registration']);
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('signOut', [AuthController::class, 'signOut'])->name('signOut');
    Route::group(['prefix' => '/game'], function () {
        Route::get('/getGame/{id}', [GameController::class, 'getGame'])->name('getGame');
        Route::get('/startGame', [GameController::class, 'startGame'])->name('startGame');
        Route::post('/checkAnswer', [GameController::class, 'checkAnswer'])->name('checkAnswer');
    });
});

Route::group(['middleware' => ['auth','checkRole:admin'], 'prefix' => '/management'], function () {
    Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('management.dashboard');
    Route::post('signOut', [AuthController::class, 'signOut'])->name('management.signOut');
    Route::resource('questions', QuestionController::class);
});
