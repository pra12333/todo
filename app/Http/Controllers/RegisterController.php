<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){
        $user=new User();
        $user->name=$request->input('username');
        $user->email=$request->input('email');
        $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $user->save();
        return redirect('login');

    }
}

