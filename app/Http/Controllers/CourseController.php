<?php

namespace App\Http\Controllers;

use App\Filters\Filterable\CourseFilterable;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\User;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $admin = Admin::where('user_id', Auth::user()->id)->first();
        $student = Student::where('user_id', Auth::user()->id)->first();
        if ($teacher) {
            $user_common = $teacher;
            $courses = Course::query()->where('teacher_id', $teacher->id);
        } elseif ($student) {
            $courses = Course::query();
            $user_common = $student;
        } else {
            $user_common = $admin;
            $courses = Course::query()->where('teacher_id', $teacher->id);
        }




        // $teacher_qourses = Course::where('teacher_id', $teacher->id);



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





        return view('course.index',  compact('courses', 'admin', 'user_common', 'teacher', 'student'));
       



    }



    public function course_show($id)
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



        $course = Course::findorfail($id);

        return view('course.show', compact('course', 'user_common', 'teacher', 'student', 'admin'));
    }


    public function student_course_show($id)
    {


        $student = Student::where('user_id', Auth::user()->id)->first();

        $user_common = $student;




        $course = Course::findorfail($id);

        return view('course.student_course_show', compact('course', 'user_common', 'student'));
    }





    public function attendance()
    {

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $user_common = $teacher;










        return view('course.attendance', compact('teacher', 'user_common'));
    }



    public function attendance_create(Request $request)
    {
        $course = Course::where('cid', $request->course_id)
            ->where('session', $request->session)
            ->first();
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $user_common = $teacher;

        $lecture = $request->lecture;

        

        $students = $course->courseStudents()->get();


        return view('student.student_list', compact('teacher', 'user_common', 'students', 'course', 'lecture'));
    }



    public function student_attendance(Request $request, $id)
    {


        $course = Course::findOrFail($id);

        $student_ids = $request->input('student_id');
        $attendances = $request->input('attendance');

        // dd($user_ids, $attendances);


        foreach ($student_ids as $index => $student_id) {
            // Get the corresponding attendance value
            $attendance = $attendances[$index] ?? 0; // Default to 0 if not set

            // Debugging purpose: check each user_id and attendance
            // Uncomment below to check




            // Update or create pivot table entry for course_user
            $course->students()->attach($student_id, ['attendance' => $attendance, 'lecture' => $request->lecture]);
        }






        return redirect()->route('course-index')->with('success', 'Attendance saved successfully.');
    }


    public function student_attendances($id)
    {

        $student = Student::where('user_id', Auth::user()->id)->first();

        $user_common = $student;
        $course = Course::findorfail($id);


        $attendances = $course->students()->where('student_id', $student->id)->get();

        // dd($attendances);





        return view('student.attendance', compact('user_common', 'student', 'attendances', 'course'));
    }





    public function see_attendance(){
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $user_common = $teacher;
        return view('course.see_attendance', compact('teacher', 'user_common'));
    }


    public function see_attendance_create(Request $request){

        $course = Course::where('cid', $request->course_id)
        ->where('session', $request->session)->first();


        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $attendances = $course->students()->get();

        return view('course.attendance_list', compact('course', 'teacher', 'attendances'));



    }



    public function lecture_attendance($id, $lecture){
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $course = Course::findorfail($id);

        $lecture_attendances = $course->students()->where('lecture', $lecture)->get();

        return view('course.lecture_attendance_list', compact('course', 'teacher', 'lecture_attendances'));

    }


    public function course_create(){
        do {
            $course_code = 'CSE' . strtoupper(Str::random(6));
        } while (Course::where('course_code', $course_code)->exists());
        
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        return view('course.create', compact('teacher', 'course_code'));
    }



    public function course_store(Request $request){

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        Course::create([
            'course_name'=>$request->course_name,
            'cid'=>$request->cid,
            'session'=>$request->session,
            'course_code'=>$request->course_code,
            'cphoto'=>'/assets/img/d2.jpeg',
            'teacher_id'=>$teacher->id,

        ]);

        return redirect()->route('course-index')->with('success', 'Attendance saved successfully.');



    }
}
