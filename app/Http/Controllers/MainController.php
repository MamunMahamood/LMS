<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Admin;

class MainController extends Controller
{
    public function home(){
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $student = Teacher::where('user_id', Auth::user()->id)->first();
        $admin = Admin::where('user_id', Auth::user()->id)->first();
        return view('index', compact('teacher', 'student', 'admin'));
    }
}