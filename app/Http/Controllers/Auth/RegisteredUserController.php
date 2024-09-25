<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\UserRole;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
        // ]);

        // if ($request->role === 'admin') {
        //     $request->admin_code == ['required', 'string', 'in:lms123']; // Replace 'your_admin_code' with the actual code
        // }



        $file = '';

        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->extension();
            // Move the uploaded file to the public/assets/img directory
            $request->photo->move(public_path('/assets/img'), $filename);
            // Store the relative file path
            $file = '/assets/img/' . $filename;
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::in(\App\UserRole::values())], // Assuming UserRole is an enum class
        ];
    
        // Conditionally add admin_code validation rule
        if ($request->input('role') === 'admin') {
            $rules['admin_code'] = ['required', 'string', 'in:lms123']; // Replace 'lms123' with your actual admin code
        }
    
        // Validate request with the rules
        $messages = [
            'admin_code.in' => 'The provided admin code is invalid.',
        ];

        // Validate request with the rules and custom messages
        $request->validate($rules, $messages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,  // Add this line
            'photo'=> $file,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        if ($user->role === UserRole::Teacher->value) {
            return redirect()->route('teacher.dashboard');
        } elseif ($user->role === UserRole::Student->value) {
            return redirect()->route('student.dashboard');
        } elseif ($user->role === UserRole::Admin->value) {
            return redirect()->route('admin.dashboard');
        }
    }
}
