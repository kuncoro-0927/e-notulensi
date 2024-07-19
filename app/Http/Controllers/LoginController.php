<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function viewlogin() 
    {
    return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return $this->authenticated($request, Auth::user());
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    

    protected function authenticated(Request $request, $user)
    
    {
        if ($user->role_id === 2) {
            return redirect('/sekretaris/dashboard');
        } elseif ($user->role_id === 1) {
            return redirect('/superadmin/dashboard');
        } else {
            return redirect('/home');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
