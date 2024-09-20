<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Models\Admin;
use App\Models\Student;
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


        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $student = Teacher::where('user_id', Auth::user()->id)->first();
        $admin = Admin::where('user_id', Auth::user()->id)->first();


        if($teacher){
            $user_common = $teacher;
        }
        elseif($student){
            $user_common = $student;
        }
        else{
            $user_common = $admin;
        }
    
    return view('teacher.dashboard', ['teacher'=> $teacher, 'user_common'=>$user_common]);
})->middleware(['auth', 'verified'])->name('teacher.dashboard');

Route::get('/student/dashboard', function () {


        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $student = Teacher::where('user_id', Auth::user()->id)->first();
        $admin = Admin::where('user_id', Auth::user()->id)->first();


        if($teacher){
            $user_common = $teacher;
        }
        elseif($student){
            $user_common = $student;
        }
        else{
            $user_common = $admin;
        }
    return view('student.dashboard', ['student'=> $student, 'user_common'=>$user_common]);
})->middleware(['auth', 'verified'])->name('student.dashboard');

Route::get('/admin/dashboard', function () {


        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $student = Teacher::where('user_id', Auth::user()->id)->first();
        $admin = Admin::where('user_id', Auth::user()->id)->first();


        if($teacher){
            $user_common = $teacher;
        }
        elseif($student){
            $user_common = $student;
        }
        else{
            $user_common = $admin;
        }
    return view('admin.dashboard', ['admin'=> $admin, 'user_common'=>$user_common]);
})->middleware(['auth', 'verified'])->name('admin.dashboard');


Route::get('/home', [MainController::class, 'home'])->name('home')->middleware('auth');

Route::get('/teacher/dashboard/tpc', [TeacherController::class, 'create'])->name('teacher-create')->middleware('auth');
Route::post('teacher-store', [TeacherController::class, 'store'])->name('teacher-store')->middleware('auth');
Route::get('/teacher/dashboard/tp/{id}', [TeacherController::class, 'teacher_profile'])->name('teacher-profile')->middleware('auth');



Route::get('/admin/dashboard/tpc', [AdminController::class, 'create'])->name('admin-create')->middleware('auth');
Route::post('admin-store', [AdminController::class, 'store'])->name('admin-store')->middleware('auth');
Route::get('/admin/dashboard/tp/{id}', [AdminController::class, 'admin_profile'])->name('admin-profile')->middleware('auth');


Route::get('/student/dashboard/tpc', [StudentController::class, 'create'])->name('student-create')->middleware('auth');
Route::post('student-store', [StudentController::class, 'store'])->name('student-store')->middleware('auth');
Route::get('/student/dashboard/tp/{id}', [StudentController::class, 'student_profile'])->name('student-profile')->middleware('auth');




Route::get('admin/dashboard/courses', [CourseController::class, 'index'])->name('course-index')->middleware('auth');
Route::get('/admin/dashboard/cc', [CourseController::class, 'course_create'])->name('course-create')->middleware('auth');
Route::get('/admin/dashboard/courses/{id}', [CourseController::class, 'course_show'])->name('course-show')->middleware('auth');



Route::get('search-filter', [CourseController::class, 'filter'])->name('courses.filter');






Route::get('/tabs/tab1', [CourseController::class, 'tab1'])->name('tabs.tab1');
Route::get('/tabs/tab2', [CourseController::class, 'tab2'])->name('tabs.tab2');
Route::get('/tabs/tab3', [CourseController::class, 'tab3'])->name('tabs.tab3');
Route::get('/tabs/tab4', [CourseController::class, 'tab4'])->name('tabs.tab4');








Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
