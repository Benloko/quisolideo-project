<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate(['email'=>'required|email','password'=>'required']);
        $user = DB::table('users')->where('email', $request->email)->first();
        if ($user && password_verify($request->password, $user->password)) {
            session(['admin_id' => $user->id]);
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email'=>'Identifiants invalides']);
    }

    public function logout()
    {
        session()->forget('admin_id');
        return redirect()->route('admin.login');
    }
}
