<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\TeacherStatus;
use App\Gender;
use App\Religion;
use App\Models\Teacher;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Course;
use App\Models\Postcomment;
use App\Models\User;

class TeacherController extends Controller
{
    public function create()
    {
        $user_common = null;
        $teacher = null;
        $admin = null;
        $student = null;
        return view('teacher.create', compact('user_common', 'teacher', 'admin', 'student'));
    }



    public function store(Request $request)
    {

        $file = '';

        if ($request->hasFile('tphoto')) {
            $filename = time() . '.' . $request->tphoto->extension();
            // Move the uploaded file to the public/assets/img directory
            $request->tphoto->move(public_path('/assets/img'), $filename);
            // Store the relative file path
            $file = '/assets/img/' . $filename;
        }


        $validatedData = $request->validate([
            // Assuming 'tphoto' is a string (file name or URL)
            'designation' => 'required|string|max:255',
            'status' => ['required'],  // Assuming you have an enum with active and inactive statuses
            'gender' => ['required'],  // Assuming you have an enum with male and female options
            'religion' => ['required'],  // Assuming you have multiple religion options in an enum
            'mobile_number' => 'required|string|max:15|regex:/^[0-9]+$/',  // Validating for mobile number format
        ]);






        $teacher = Teacher::create([
            'tphoto' => $file,
            'designation' => $validatedData['designation'],
            'status' => $validatedData['status'],
            'gender' => $validatedData['gender'],
            'religion' => $validatedData['religion'],
            'mobile_number' => $validatedData['mobile_number'],
            'user_id' => Auth::user()->id,
            'education' => $request->education,
            'location' => $request->location,
            'skill' => $request->skill,
            'research_interest' => $request->research_interest,

        ]);

        return redirect(route('teacher.dashboard'));
    }

    public function teacher_profile($id)
    {
        $teacher = Teacher::findorfail($id);
        $user_common = $teacher;

        return view('teacher.tprofile', compact('teacher', 'user_common'));
    }




    public function teacher_activity($id)
    {
        
        $user_common = Teacher::where('user_id', Auth::user()->id)->first();
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $course = Course::findorfail($id);
        $posts = $course->userPosts()->get();
        $comments = Postcomment::all();
        $users_for_comment = User::all();
        return view('teacher.activity', compact('teacher', 'course', 'posts', 'comments','users_for_comment'));
    }

    public function teacher_activity_pre()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $user_common = $teacher;
       
        return view('teacher.activity_pre', compact('user_common', 'teacher'));
    }


    public function teacher_activity_pos(Request $request)
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $user_common = $teacher;



        $course = Course::where('cid', $request->course_id)
            ->where('session', $request->session)
            ->first();


            


            
        return redirect(route('teacher-activity', $course));
    }



    public function teacher_post(Request $request){
        $course = Course::findorfail($request->course_id);

        $course->userPosts()->attach($request->user_id, ['post'=> $request->post]);

        
        return redirect()->back()->with('success', 'Job created successfully!');
    }



    public function teacher_post_comment(Request $request){

        

        $comment = Postcomment::create([
            'post_id' => $request->post_id,
            'comment' => $request->comment,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Job created successfully!');
    }
}
