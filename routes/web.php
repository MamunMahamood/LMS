<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;

use App\UserRole;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->role === UserRole::Teacher->value) {
        return redirect()->route('teacher.dashboard');
    } elseif ($user->role === UserRole::Student->value) {
        return redirect()->route('student.dashboard');
    } elseif ($user->role === UserRole::Admin->value) {
        return redirect()->route('admin.dashboard');
    }
    
    // Default redirect or fallback if no role matches
    return redirect()->route('default.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/teacher/dashboard', function () {
    return view('teacher.dashboard');
})->middleware(['auth', 'verified'])->name('teacher.dashboard');

Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})->middleware(['auth', 'verified'])->name('student.dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');


Route::get('/home', [MainController::class, 'home'])->name('home')->middleware('auth');






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
