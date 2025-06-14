<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetaBudayaController;

// Route::get('/', function () {
//     return view('user.index');
// });
Route::get('/', [AuthController::class, 'home'])->name('welcome');

// guest
Route::get('/user', [AuthController::class, 'home']);

Route::get('/user/konten', [KontenController::class, 'index'])->name('konten.index');
Route::get('/konten-detail/{id}', [KontenController::class, 'show'])->name('kontenbudaya.show');

Route::get('/user/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');


// route Login n regis submit
Route::middleware(['guest'])->group(function () {
    Route::get('/user/regis', function () {
        return view('user.regis');
    })->name('regis');

    Route::post('/register', [RegisterController::class, 'submit'])->name('register.submit');
    Route::get('/login', [AuthController::class, 'ShowLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', [AuthController::class, 'home'])->name('home');

// Route untuk halaman peta budaya
Route::get('/peta-budaya', [PetaBudayaController::class, 'index'])->name('peta-budaya');

// Route modal content
Route::get('/konten/{id}', [PetaBudayaController::class, 'show'])->name('konten.show');

//routes user
Route::group(['middleware' => ['auth']], function() {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('konten')->group(function () {

        Route::get('/konten/histori', [KontenController::class, 'histori'])->name('konten.histori');
        Route::get('/konten/create', [KontenController::class, 'create'])->name('konten.create');
        Route::post('/store', [KontenController::class, 'store'])->name('konten.store');
        Route::delete('/konten/{id}', [KontenController::class, 'destroy'])->name('konten.destroy');
        Route::get('/konten/{id}/edit', [KontenController::class, 'edit'])->name('konten.edit');
        Route::put('/{id}', [KontenController::class, 'update'])->name('konten.update');
    });

    Route::prefix('event')->group(function () {

        Route::get('/event/histori', [EventController::class, 'histori'])->name('event.histori');
        Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
        Route::post('/store', [EventController::class, 'store'])->name('event.store');
        Route::delete('/event/{id}', [EventController::class, 'destroy'])->name('event.destroy');
        Route::get('/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
        Route::put('/{id}', [EventController::class, 'update'])->name('event.update');

    });

    Route::get('/badge', [BadgeController::class, 'index'])->name('badge.index');
    Route::get('badge/quiz', [BadgeController::class, 'quiz'])->name('badge.quiz');
    Route::post('/submit-quiz', [BadgeController::class, 'submitQuiz'])->name('badge.submit-quiz');

});

//admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/konten/create', [AdminController::class, 'create'])->name('konten.create');
    Route::post('/konten/storeAdmin', [KontenController::class, 'storeAdmin'])->name('konten.storeAdmin');
    Route::get('/konten/read', [AdminController::class, 'index'])->name('konten.index');
    Route::get('/konten/{id}/edit', [AdminController::class, 'edit'])->name('konten.edit');
    Route::put('/konten/{id}', [AdminController::class, 'update'])->name('konten.update');
    Route::delete('/konten/{id}', [AdminController::class, 'destroy'])->name('konten.destroy');

    // profile admin
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile'); // Admin Profile
    Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit'); // Edit Profile
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update'); // Update Profile

    // Event Routes
    Route::get('/events', [EventController::class, 'indexAdmin'])->name('events.index'); // Menampilkan daftar event
    Route::get('/events/create', [EventController::class, 'createAdmin'])->name('events.create'); // Form tambah event
    Route::post('/events/store', [EventController::class, 'storeAdmin'])->name('events.store');
    Route::get('/events/{event}', [EventController::class, 'showAdmin'])->name('events.show');
    Route::put('/events/{event}', [EventController::class, 'updateAdmin'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroyAdmin'])->name('events.destroy');

    Route::post('/content/{id}/approve', [AdminController::class, 'approveContent'])->name('content.approve');
    Route::post('/content/{id}/reject', [AdminController::class, 'rejectContent'])->name('content.reject');
    Route::post('/recalculate-badges', [BadgeController::class, 'recalculateAllBadges'])->name('recalculate.badges');
});

