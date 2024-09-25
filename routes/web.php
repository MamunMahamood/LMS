<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizController;
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
        $user_common = $teacher;
        


    return view('teacher.dashboard', ['teacher'=> $teacher, 'user_common'=>$user_common]);
})->middleware(['auth', 'verified'])->name('teacher.dashboard');

Route::get('/student/dashboard', function () {


       
   
    $student = Student::where('user_id', Auth::user()->id)->first();
    

    $user_common = $student;
    
    return view('student.dashboard', ['student'=> $student,
            
            'user_common'=>$user_common]);
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
Route::post('/student/dashboard/cec', [StudentController::class, 'student_store'])->name('student-store')->middleware('auth');



Route::get('admin/dashboard/courses', [CourseController::class, 'index'])->name('course-index')->middleware('auth');
Route::get('/admin/dashboard/cc', [CourseController::class, 'course_create'])->name('course-create')->middleware('auth');
Route::get('/admin/dashboard/courses/{id}', [CourseController::class, 'course_show'])->name('course-show')->middleware('auth');
Route::get('/student/dashboard/courses/{id}', [CourseController::class, 'student_course_show'])->name('student-course-show')->middleware('auth');
Route::get('/student/dashboard/courses/{id}/quizzes', [StudentController::class, 'student_course_quizzes'])->name('student-course-quizzes')->middleware('auth');
Route::get('/student/dashboard/quizzes/{id}', [StudentController::class, 'attend_quiz'])->name('attend-quiz')->middleware('auth');

Route::get('/teacher/dashboard/quizzes/new/{id}', [QuizController::class, 'quiz_create'])->name('quiz-create')->middleware('auth');
Route::get('/teacher/dashboard/quizzes/pre', [QuizController::class, 'quiz_create_pre'])->name('quiz-create-pre')->middleware('auth');
Route::post('/teacher/dashboard/quizzes/pre', [QuizController::class, 'quiz_create_pre_store'])->name('quiz-create-pre-store')->middleware('auth');
Route::post('/teacher/dashboard/quizzes/new', [QuizController::class, 'quiz_store'])->name('quiz-store')->middleware('auth');
Route::get('/teacher/dashboard/quizzes', [QuizController::class, 'quiz_index'])->name('quiz-index')->middleware('auth');




Route::get('search-filter', [CourseController::class, 'filter'])->name('courses.filter');












Route::get('/admin/dashboard/course/attendance', [CourseController::class, 'attendance'])->name('course-attendance');
Route::get('/student/dashboard/course/attendance/{id}', [CourseController::class, 'student_attendances'])->name('student-course-attendance');
Route::post('/admin/dashboard/course/attendance-create', [CourseController::class, 'attendance_create'])->name('course-attendance-create');
Route::post('admin/dashboard/course/student-attendance/{id}', [CourseController::class, 'student_attendance'])->name('student-attendance');
Route::get('/admin/dashboard/course/attendance/see', [CourseController::class, 'see_attendance'])->name('teacher-see-attendance');
Route::post('/admin/dashboard/course/attendance/see-attendance', [CourseController::class, 'see_attendance_create'])->name('see-attendance-create');
Route::get('/admin/dashboard/course/attendance/see-attendance/{id}/{lecture}', [CourseController::class, 'lecture_attendance'])->name('lecture-attendance');




Route::get('student/dashboard/courses', [StudentController::class, 'student_course_index'])->name('student-course-index')->middleware('auth');
Route::get('/student/dashboard/ce', [StudentController::class, 'course_enroll'])->name('student-course-enroll')->middleware('auth');
Route::post('/student/dashboard/cec', [StudentController::class, 'course_enroll_store'])->name('student-course-enroll-create')->middleware('auth');









Route::get('/teacher/dashboard/activity/pre/{id}', [TeacherController::class, 'teacher_activity'])->name('teacher-activity')->middleware('auth');
Route::get('/teacher/dashboard/activity/pre', [TeacherController::class, 'teacher_activity_pre'])->name('teacher-activity-pre')->middleware('auth');
Route::post('/teacher/dashboard/activity/pre/pos', [TeacherController::class, 'teacher_activity_pos'])->name('teacher-activity-pos')->middleware('auth');
Route::post('/teacher/dashboard/activity/pre/post', [TeacherController::class, 'teacher_post'])->name('teacher-post')->middleware('auth');
Route::post('/comment', [TeacherController::class, 'teacher_post_comment'])->name('teacher-post-comment')->middleware('auth');








Route::get('/student/dashboard/activity/pre/{id}', [StudentController::class, 'student_activity'])->name('student-activity')->middleware('auth');












Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
