<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogConnexionController;
use App\Http\Controllers\LogModificationController;

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
    return view('welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/utilisateurs', [UtilisateurController::class, 'index'])->name('utilisateurs.index');
Route::delete('/utilisateurs/{id}', [UtilisateurController::class, 'destroy'])->name('utilisateurs.destroy');

// Authentification classique
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/utilisateurs/{id}/edit', [UtilisateurController::class, 'edit'])->name('utilisateurs.edit');
Route::put('/utilisateurs/{id}', [UtilisateurController::class, 'update'])->name('utilisateurs.update');

Route::patch('/utilisateurs/{id}/activation', [UtilisateurController::class, 'toggleActivation'])->name('utilisateurs.toggle');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


// Historique des connexions
Route::get('/logs', [LogConnexionController::class, 'index'])->name('logs.index')->middleware('auth');

// Historique des modifications
Route::get('/modifications', [LogModificationController::class, 'index'])->name('modifications.index')->middleware('auth');


// Commenté car on n'utilise plus les routes Inertia d'authentification
// require __DIR__.'/auth.php';
