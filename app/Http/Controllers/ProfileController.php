<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        if(Auth::user()->level==2){
            return back();
        }
        return view('profile.profile',[
            'profile' => Auth::user()->id
        ]);
    }
    public function profile(Request $request)
    {
        return view('profile.profile',[
            'profile' => $request->id_profile
        ]);
    }
}
