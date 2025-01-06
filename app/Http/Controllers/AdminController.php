<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Applicant;
use App\Models\Todo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function showLoginForms(){
        return view('admin.login');
    }

    public function login(Request $req){
       $req->validate([
        'email' => 'required|email',
        'password'=> 'required',
       ]);

    $admin = Admin::where('email', $req->email)->first();

    if (!$admin) {
    
        return back()->withErrors(['email' => 'This email is not registered in the system.']);
    }

    if (!Hash::check($req->password, $admin->password)) {
    
        return back()->withErrors(['password' => 'The password is incorrect.']);
    }

    Auth::guard('admin')->login($admin);

    return redirect()->route('admin.dashboard');
     }

     public function showRegisterForm()
     {
         return view('admin.register');
     }
 
     public function register(Request $req)
     {
         $req->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:admin,username|max:255',
                'email' => 'required|email|unique:admin,email',
                'password' => 'required|string|min:5|confirmed',
         ]);
 
         $admin = new Admin();
         $admin->name = $req->name;
         $admin->username = $req->username;
         $admin->email = $req->email;
         $admin->password = Hash::make($req->password); 
         $admin->save();

         return redirect()->route('admin.login')->with('success', 'Admin registered successfully!');

         Auth::login($admin);
 
         return redirect()->route('admin.dashboard');
     }

    public function dashboard(){
        $totalUsers = Applicant::count();
        $totals = Todo::count();
        return view('admin.dashboard',compact('totalUsers', 'totals'));
    }
    
    public function viewAllUsers(){
        $users = Applicant::all();
        return view('admin.view_users',compact('users'));
    }

    public function viewUserTodos($id){
        $user = Applicant::findOrFail($id);
        $todos = Todo::where('applicant_id', $id)->get();
        return view('admin.user_todos',compact('user', 'todos'));
    }

    public function showProfile(){
        return view ('admin.profile');
    }
    
    public function updateProfile(Request $req){
        $req->validate([
            'name' => 'required|string|max:200',
            'username' => 'required|string|max:200|unique:admin,username,' . auth()->guard('admin')->id(),
            'email' => 'required|email|unique:admin,email,' . auth()->guard('admin')->id(),
            'password' => 'nullable|string|min:5|confirmed',
        ]);

        $admin = auth()->guard('admin')->user();

        $admin->name = $req->name;
        $admin->username = $req->username;
        $admin->email = $req->email;

        if($req->password){
            $admin->password = Hash::make($req->password);
        }
        // $admin->save();
        return redirect()->route('admin.profile')->with('success', 'Profile updated Sucessfully');
    }

    public function destroy($id){
        $user = Applicant::findOrFail($id);
        Todo::where('applicant_id',$id)->delete();
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User and their To-Do has been deleted Sucessfully');
    }

    public function logout(){
        // Auth::logout();
        // return redirect()->route('admin.login');
        auth()->guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
