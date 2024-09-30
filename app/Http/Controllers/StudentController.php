<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\User;
use App\Models\Postcomment;
use App\Models\Quiz;

class StudentController extends Controller
{


    public function student_course_index(){
        $student = Student::where('user_id', Auth::user()->id)->first();


        if($student){
            $courses = $student->studentCourses()->get();
            return view('student.course_index', compact('courses', 'student'));

        }
        else{
            $student = null;
            $courses = [];
            return view('student.course_index', compact('courses', 'student'));
        }


        

        // dd($student->user->name);
        
    }



    // public function index(){


    //     $student = Student::findorfail(Auth::user()->id);
        
    //     // dd($student->father_name);
    //     $courses= $student->studentCourses()->get();
    //     dd($courses);

    //     return view('student.index',  compact('courses','student'));
    // }
    public function student_profile($id){
        $student = Student::findorfail($id);

        // 
        
        $user_common = $student;


        return view('student.sprofile', compact('student', 'user_common'));
    }




    public function course_enroll(){
        $student = Student::where('user_id',Auth::user()->id)->first();
        $user_common = $student;

        
        return view('student.enroll', compact('student', 'user_common'));
    }




    public function course_enroll_store(Request $request){
        $course = Course::where('course_code', $request->course_code)->first();
        $student = Student::findorfail(Auth::user()->id);
        
        $course->courseStudents()->attach($student);

        return redirect()->route('student-course-index')->with('success', 'Attendance saved successfully.');
    }


    public function student_activity($id)
    {
        
        $student = Student::where('user_id',Auth::user())->first();
        $course = Course::findorfail($id);
        $posts = $course->userPosts()->get();
        $comments = Postcomment::all();
        $users_for_comment = User::all();
        return view('teacher.activity', compact('student', 'course', 'posts','comments', 'users_for_comment'));
    }




    public function create(){
        $student = Student::where('user_id', Auth::user()->id)->first();
        
        return view('student.create', compact('student'));
    }



    public function store(Request $request){

        $student = Student::create([
            'sphoto' => '/assets/img/1.jpg',
            'father_name' => $request->input('father_name'),
            'mother_name' => $request->input('mother_name'),
            'hall' => $request->input('hall'),
            'session' => $request->input('session'),
            'department' => $request->input('department'),
            'location' => $request->input('location'),
            'status' => $request->input('status'),
            'gender' => $request->input('gender'),
            'sid' => $request->input('sid'),
            'religion' => $request->input('religion'),
            'mobile_number' => $request->input('mobile_number'),
            'user_id' => Auth::user()->id,
        ]);



        return redirect(route('student.dashboard'));



        

    }


    public function student_course_quizzes($id){
        $student = Student::where('user_id', Auth::user()->id)->first();
        $course = Course::findorfail($id);

        $quizzes = $course->quizzes()->get();

        

        return view('student.quiz_index', compact('student', 'course', 'quizzes'));
        
    }


    public function attend_quiz($id){

        $student = Student::where('user_id', Auth::user()->id)->first();

        $quiz = Quiz::findorfail($id);

        $questions = $quiz->questions()->get();

        return view('student.attend_quiz', compact('student', 'questions', 'quiz'));

    }

}
