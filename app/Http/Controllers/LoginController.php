<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            return "Selamat Datang".$user->instansi;
        }

        return view('login');
    }

    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'username' =>'required',
                'password' =>'required',
            ]
            );

        $kredensil = $request->only('username','password');

        $user = User::where('username', $request->username)->where('password', md5($request->password))->first();
        if (Auth::attempt($kredensil)) {
            $user = Auth::user();
            return "Selamat Datang".$user->instansi;
        }

        return redirect('login')
                                ->withInput()
                                ->withErrors(['login_gagal' => 'Username Password Salah']);
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect('login');
    }
}


