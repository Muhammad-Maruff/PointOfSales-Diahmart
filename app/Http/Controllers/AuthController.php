<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register() {
        return view('authentication.register');
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone_number' => 'nullable|max:15',
            'address' => 'nullable|max:255',
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:5|confirmed',
        ]);
    
        $user = new User;
        $user->name = $validated['nama'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone_number'] ?? null;
        $user->address = $validated['address'] ?? null;
        $user->username = $validated['username'];
        $user->password = Hash::make($validated['password']);
        $user->role_id = 2;
        $user->isactive = false;
        $user->save();
    
        Session::flash('status', 'success');
        Session::flash('message', 'Register berhasil! Menunggu approval admin.');
        
        return redirect('register');
    }

    public function login() {
        return view('authentication.login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (!Auth::user()->isactive)
            {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Akun anda belum aktif, silahkan hubungi admin');
                return redirect('login');
            }

            $request->session()->regenerate();

            if(Auth::user()->role_id == 1){
                Session::flash('status', 'success');
                Session::flash('message', 'Login Success!');
                return redirect()->route('dashboard');
            }
            if(Auth::user()->role_id != 1){
                return redirect ('budgets');
            }
        }
        
        Session::flash('status', 'failed');
        Session::flash('message', 'Email atau password yang anda masukkan salah');
        return redirect('login');
    }
    
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

}
