<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    private const ROLE_ADMIN_ENTREPRENARIAT = 'admin_entreprenariat';
    private const ROLE_ADMIN_BOUTIQUE = 'admin_boutique';

    public function showLogin()
    {
        return redirect()->route('admin.entreprenariat.login');
    }

    public function showEntreprenariatLogin()
    {
        return view('admin.login', [
            'spaceTitle' => 'Admin — Entreprenariat',
            'postRouteName' => 'admin.entreprenariat.login.post',
        ]);
    }

    public function showBoutiqueLogin()
    {
        return view('admin.login', [
            'spaceTitle' => 'Admin — Boutique',
            'postRouteName' => 'admin.boutique.login.post',
        ]);
    }

    public function doEntreprenariatLogin(Request $request)
    {
        return $this->doRoleLogin($request, self::ROLE_ADMIN_ENTREPRENARIAT);
    }

    public function doBoutiqueLogin(Request $request)
    {
        return $this->doRoleLogin($request, self::ROLE_ADMIN_BOUTIQUE);
    }

    public function doLogin(Request $request)
    {
        $request->validate(['email'=>'required|email','password'=>'required']);
        $user = DB::table('users')
            ->select(['id', 'email', 'password', 'role', 'name'])
            ->where('email', $request->email)
            ->first();

        $allowedRoles = [self::ROLE_ADMIN_ENTREPRENARIAT, self::ROLE_ADMIN_BOUTIQUE];
        if ($user && in_array($user->role, $allowedRoles, true) && password_verify($request->password, $user->password)) {
            session([
                'admin_id' => $user->id,
                'admin_role' => $user->role,
                'admin_name' => $user->name,
            ]);

            if ($user->role === self::ROLE_ADMIN_BOUTIQUE) {
                return redirect()->route('admin.boutique.dashboard');
            }
            return redirect()->route('admin.entreprenariat.dashboard');
        }
        return back()->withErrors(['email'=>'Identifiants invalides']);
    }

    private function doRoleLogin(Request $request, string $expectedRole)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);

        $user = DB::table('users')
            ->select(['id', 'email', 'password', 'role', 'name'])
            ->where('email', $request->email)
            ->first();

        if (!$user || !password_verify($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Identifiants invalides']);
        }

        if ($user->role !== $expectedRole) {
            return back()->withErrors(['email' => "Ce compte n'a pas accès à cet espace admin."]);
        }

        session([
            'admin_id' => $user->id,
            'admin_role' => $user->role,
            'admin_name' => $user->name,
        ]);

        if ($expectedRole === self::ROLE_ADMIN_BOUTIQUE) {
            return redirect()->route('admin.boutique.dashboard');
        }

        return redirect()->route('admin.entreprenariat.dashboard');
    }

    public function logout()
    {
        $role = session('admin_role');
        session()->forget(['admin_id', 'admin_role', 'admin_name']);

        if ($role === self::ROLE_ADMIN_BOUTIQUE) {
            return redirect()->route('admin.boutique.login');
        }

        if ($role === self::ROLE_ADMIN_ENTREPRENARIAT) {
            return redirect()->route('admin.entreprenariat.login');
        }

        return redirect()->route('admin.login');
    }
}
