<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
        public function showRegisterForm(){
            return view('applicant.register');
        }

        public function register(Request $req){
          $req -> validate([
            'username' => 'required|unique:applicant',
            'name' => 'required',
            'email' => 'required|email|unique:applicant',
            'password' => 'required|string|min:5|confirmed',
          ]);

          $applicant = Applicant::create([
                'username' => $req->username,
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->password),
          ]);

          return redirect()->route('applicant.login')->with('success','You have been registered in the system');
          Auth::login($applicant);
          return redirect()->route('applicant.dashboard');
        }
            public function showLoginForm(){
                return view('applicant.login');
            }
            public function login(Request $req){
                $req->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                ]);

                $applicant = Applicant::where('email',$req->email)->first();

                if(!$applicant){
                    return back()->withErrors(['email'=>'This email is not registered in the system']);
                }
                if(!Hash::check($req->password, $applicant->password)){
                    return back()->withErrors(['password'=>'Password unmatched']);
                }
                Auth::guard('applicant')->login($applicant);
                return redirect()->route('applicant.dashboard');
    }
   public function dashboard()
{
    $applicant = auth()->guard('applicant')->user();
    if (!$applicant) {
        return redirect()->route('applicant.login');
    }
    
    $todos = $applicant->todos;
    
    return view('applicant.dashboard', compact('todos'));
}

    public function logout(){
        // Auth::logout();
        // return redirect()->route('applicant.login');
        auth()->guard('applicant')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('applicant.login');
    }
}
