<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class GlobalController extends Controller
{
    public function index(){
        $user = Auth::user();
        return "Selamat Datang".$user->instansi;
    }
}
