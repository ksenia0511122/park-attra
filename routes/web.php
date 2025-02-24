<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminController;

// Главная страница (доступна всем)
Route::get('/', function () {
    return view('home');
})->name('home');

// Страница покупки билетов (доступна всем)
Route::get('/tickets', function () {
    return view('tickets');
})->name('tickets');

// Гостевые маршруты (только для НЕавторизованных пользователей)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Защищенные маршруты (только для авторизованных пользователей)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Личный кабинет (добавишь позже)
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Аттракционы
    Route::get('/attractions', [AttractionController::class, 'index'])->name('attractions');
    Route::post('/attractions', [AttractionController::class, 'store']);

    // Покупка и управление билетами
    Route::post('/tickets/buy', [TicketController::class, 'buy'])->name('tickets.buy');
    Route::post('/tickets/cancel/{id}', [TicketController::class, 'cancel'])->name('tickets.cancel');
    Route::post('/tickets/refund/{id}', [TicketController::class, 'refund'])->name('tickets.refund');

    // Админ-панель (только для администраторов)
    Route::middleware('admin')->group(function () {
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    });
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/attractions', [AttractionController::class, 'index'])->name('admin.attractions');
        Route::get('/admin/attractions/create', [AttractionController::class, 'create'])->name('admin.attractions.create');
        Route::post('/admin/attractions', [AttractionController::class, 'store'])->name('admin.attractions.store');
        Route::delete('/admin/attractions/{id}', [AttractionController::class, 'destroy'])->name('admin.attractions.destroy');
    });

    Route::get('/tickets', [AttractionController::class, 'showAll'])->name('tickets');

});
