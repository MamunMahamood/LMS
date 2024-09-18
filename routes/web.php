<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Models\Admin;

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
    $teacher = Teacher::where('id', Auth::user()->id)->first();
    return view('teacher.dashboard', ['teacher'=> $teacher]);
})->middleware(['auth', 'verified'])->name('teacher.dashboard');

Route::get('/student/dashboard', function () {
    $student = Teacher::where('id', Auth::user()->id)->first();
    return view('student.dashboard', ['student'=> $student]);
})->middleware(['auth', 'verified'])->name('student.dashboard');

Route::get('/admin/dashboard', function () {
    $admin = Admin::where('user_id', Auth::user()->id)->first();
    return view('admin.dashboard', ['admin'=> $admin]);
})->middleware(['auth', 'verified'])->name('admin.dashboard');


Route::get('/home', [MainController::class, 'home'])->name('home')->middleware('auth');

Route::get('/teacher/dashboard/tpc', [TeacherController::class, 'create'])->name('teacher-create')->middleware('auth');
Route::post('teacher-store', [TeacherController::class, 'store'])->name('teacher-store')->middleware('auth');
Route::get('/teacher/dashboard/tp/{id}', [TeacherController::class, 'teacher_profile'])->name('teacher-profile')->middleware('auth');



Route::get('/admin/dashboard/tpc', [AdminController::class, 'create'])->name('admin-create')->middleware('auth');
Route::post('admin-store', [AdminController::class, 'store'])->name('admin-store')->middleware('auth');
Route::get('/admin/dashboard/tp/{id}', [AdminController::class, 'admin_profile'])->name('admin-profile')->middleware('auth');









Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
