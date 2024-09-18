<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin_profile($id){

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $admin = Admin::where('user_id', Auth::user()->id)->first();
        $student = Student::where('user_id', Auth::user()->id)->first();
        if($teacher){
            $user_common = $teacher;
        }
        elseif($student){
            $user_common = $student;
        }
        else{
            $user_common = $admin;
        }
        
        $admin = Admin::findorfail($id);
        return view('admin.aprofile', compact('admin','user_common'));
    }
}
