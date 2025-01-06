<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //Let's being the Profile Controller

    public function show(){
        $applicant = auth()->guard('applicant')->user();
        return view ('applicant.profile', compact('applicant'));
    }

    public function update(Request $req){
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:applicant,email,' . auth()->guard('applicant')->user()->id,
            'username' => 'required|string|max:255|unique:applicant,username,' . auth()->guard('applicant')->user()->id,
            'password' => 'nullable|string|min:5|confirmed',
        ]);

        $applicant = auth()->guard('applicant')->user();

        $applicant->update([
            'name' => $req->name,
            'email' => $req->email,
            'username' => $req->username,
        ]);

        if ($req->password) {
            $applicant->password = Hash::make($req->password);
        }

        $applicant->save();

        return redirect()->route('applicant.profile')->with('success','Profile Updated Successfully');
    }
}
