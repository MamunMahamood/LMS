<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;

class CourseController extends Controller
{
    public function index()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $admin = Admin::where('user_id', Auth::user()->id)->first();
        $student = Student::where('user_id', Auth::user()->id)->first();
        if ($teacher) {
            $user_common = $teacher;
        } elseif ($student) {
            $user_common = $student;
        } else {
            $user_common = $admin;
        }
        $courses = Course::all();

        return view('course.index', compact('courses', 'admin', 'user_common', 'teacher'));
    }

    public function filter(Request $request)
{
    $query = Course::query();

    if ($request->filled('course_name')) {
        $query->where('course_name', 'like', '%' . $request->course_name . '%');
    }

    if ($request->filled('cid')) {
        $query->where('cid', 'like', '%' . $request->cid . '%');
    }

    if ($request->filled('session')) {
        $query->where('session', 'like', '%' . $request->session . '%');
    }

    $courses = $query->get();

    // Return only the part of the view that needs updating (the filtered courses)
    return view('courses.index.filtered_courses', compact('courses'))->render();
}

}
