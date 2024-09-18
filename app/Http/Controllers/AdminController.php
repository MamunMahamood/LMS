<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin_profile($id){
        
        $admin = Admin::findorfail($id);
        return view('admin.aprofile', compact('admin'));
    }
}
