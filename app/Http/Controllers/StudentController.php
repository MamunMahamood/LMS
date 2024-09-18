<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function student_profile($id){
        $student = Student::findorfail($id);

        return view('student.sprofile', compact('student'));
    }
}
