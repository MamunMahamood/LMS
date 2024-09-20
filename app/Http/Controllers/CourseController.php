<?php

namespace App\Http\Controllers;

use App\Filters\Filterable\CourseFilterable;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;

class CourseController extends Controller
{
    public function index( Request $request)
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



        

        

        // if($request->ajax()){
        //     $courses= $query->where('course_name', 'LIKE', '%'.$request->course_name.'%')
        //     ->orwhere('cid',  'LIKE', '%'.$request->cid.'%')
        //     ->orwhere('session',  'LIKE', '%'.$request->session.'%')
        //     ->get();
        //     return response()->json(['courses'=> $courses]);
        // }
        // else{
        //     $courses = $query->get();
        //     return view('course.index', compact('courses', 'admin', 'user_common', 'teacher'));
        // }

    
        // $teacher_qourses = Course::where('teacher_id', $teacher->id);
        $courses = Course::query()->where('teacher_id', $teacher->id);


    if (!empty($request->course_name)) {
        $courses->where('course_name', 'like', '%' . $request->course_name . '%');
    }

    if (!empty($request->cid)) {
        $courses->where('cid', $request->cid);
    }

    if (!empty($request->session)) {
        $courses->where('session', $request->session);
    }

    $courses = $courses->get();
        
        return view('course.index',  compact('courses', 'admin', 'user_common', 'teacher'));
        // return redirect()->route('course-index', ['courses'=> $courses, 'admin'=> $admin, 'user_common'=> $user_common, 'teacher'=> $teacher]);
        

        
    }



    public function course_show($id){

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



        $course = Course::findorfail($id);

        return view('course.show', compact('course', 'user_common', 'teacher', 'student', 'admin'));
    }




    public function tab1() {
        return view('course.page1');
    }
    
    public function tab2() {
        return view('tabs.tab2-content');
    }
    
    public function tab3() {
        return view('tabs.tab3-content');
    }
    
    public function tab4() {
        return view('tabs.tab4-content');
    }
    
    

    
    

}
