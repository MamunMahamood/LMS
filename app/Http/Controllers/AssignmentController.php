<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Student;

class AssignmentController extends Controller
{
    public function teacher_set_course_for_assignment(){
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $courses = Course::where('teacher_id', $teacher->id)->get();
        $sessions = Course::select('session')->distinct()->get();
        return view('assignment.set_course_for_assignment', compact('teacher','courses', 'sessions'));

    }



    public function assignment_create_pre_store(Request $request){
        $course = Course::where('cid', $request->course_id)
                      ->where('session', $request->session)
                      ->first();
    
   return redirect()->route('assignment-create', $course)->with('message', 'State saved correctly!!!');

    }


    public function assignment_create($id){
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $course = Course::findorfail($id);
        return view('assignment.create', compact('teacher', 'course'));
    }


    public function assignment_store(Request $request){


        $file = '';

        if ($request->hasFile('assignment_file')) {
            $filename = time() . '.' . $request->assignment_file->extension();
            // Move the uploaded file to the public/assets/img directory
            $request->assignment_file->move(public_path('/assets/file'), $filename);
            // Store the relative file path
            $file = '/assets/file/' . $filename;
        }



        $assignment = Assignment::create([
            'assignment_file' => $file,
            'title' => $request->title,
            'course_id' => $request->course_id,
            
          

        ]);

        return redirect(route('teacher.dashboard'));

    }



    public function assignment_index_pre(){

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $courses = Course::where('teacher_id', $teacher->id)->get();
        $sessions = Course::select('session')->distinct()->get();
        return view('assignment.set_course_for_index', compact('teacher','courses', 'sessions'));

    }


    public function assignment_index_pre_store(Request $request){

        $course = Course::where('cid', $request->course_id)
        ->where('session', $request->session)
        ->first();

     return redirect()->route('assignment-index', $course)->with('message', 'State saved correctly!!!');

    }

    public function assignment_index($id){

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $course = Course::findorfail($id);


        $assignments = $course->assignments()->get();

        return view('assignment.index', compact('teacher', 'assignments'));





    }



    public function assignment_students($id){
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $assignment = Assignment::findorfail($id);
        $course = Course::findorfail($assignment->course->id);
        $students = $assignment->students()->get();
        
        return view('teacher.assignment_student_list', compact('teacher','students', 'course','assignment'));

    }







   public function student_course_assignments($id){

        $student = Student::where('user_id', Auth::user()->id)->first();
        $course = Course::findorfail($id);

        $assignments = $course->assignments()->get();

        

        return view('student.assignment_index', compact('student', 'course', 'assignments'));
   }

   public function student_upload_assignment($id){

        $student = Student::where('user_id', Auth::user()->id)->first();
        $assignment = Assignment::findorfail($id);
        return view('student.upload', compact('student', 'assignment'));

   }




   public function assignment_upload(Request $request){

    $file = '';

        if ($request->hasFile('assignment_file')) {
            $filename = time() . '.' . $request->assignment_file->extension();
            // Move the uploaded file to the public/assets/img directory
            $request->assignment_file->move(public_path('/assets/file'), $filename);
            // Store the relative file path
            $file = '/assets/file/' . $filename;
        }



        $assignment = Assignment::findorfail($request->assignment_id);

        $assignment->students()->attach($request->student_id, ['assignment_file'=> $file]);



        return redirect(route('student.dashboard'));
     


   }
}
