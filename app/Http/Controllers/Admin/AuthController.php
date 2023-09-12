<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('pages.auth.login');
    }

    public function indexRegister()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            "fullname" => "required|min:3",
            "email" => "required|email",
            "password" => "required"
        ]);

        // dd($request->all());
        DB::beginTransaction();
        try {
            $user = new User;
            $user->name = $request->fullname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            DB::commit();
            return redirect()->route('auth.index.login');
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        // dd($request->all());
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }

        return redirect()->route('auth.index.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.index.login');
    }
}
