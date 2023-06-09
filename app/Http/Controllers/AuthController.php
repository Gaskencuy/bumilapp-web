<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        Session::flash('email', $request->email);
        Session::flash('password', $request->password);

        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            $userLogin = $user->id_role;
        } else {
            $userLogin = 3;
        }

        if ($userLogin == 1) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended('/index')->with('loginberhasil', 'login berhasil');
            } else {
                return redirect()->intended('/login')->with('loginerror', 'login error');
            }
        } elseif ($userLogin == 2) {

            return redirect()->intended('/login')->with('bukanadmin', 'login error');
        } elseif ($userLogin == 3) {

            return redirect()->intended('/login')->with('failed', 'login error');
        }
    }

    public function profilupdate(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'username' => 'required|unique:users,username,' . $id . ',id',
                'email' => 'required|email|unique:users,email,' . $id . ',id',
                'oldpassword' => 'required',
                'password' => 'required',
                'repassword' => 'required', 'same:password',
            ],

            [
                'name.required' => 'name tidak boleh kosong',
                'username.required' => 'username tidak boleh kosong',
                'username.unique' => 'username sudah ada',
                'email.unique' => 'email sudah ada',
                'email.email' => 'email tidak valid',
                'email.required' => 'email tidak boleh kosong',
                'oldpassword.required' => 'oldpassword tidak boleh kosong',
                'password.required' => 'password tidak boleh kosong',
                'repassword.required' => 'repassword tidak boleh kosong',
                'repassword.same' => 'repassword tidak sama dengan password',
            ],
        );

        if (Hash::check($request->oldpassword, Auth::user()->password)) {

            if ($request->password == $request->repassword) {
                $user = User::find($id);
                $user->name = $request->name;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect()->intended('/index')->with('updateprofil', 'berhasil update profil');
            } else {

                return redirect()->intended('/index')->with('passwordtidaksama', 'gagal update profil');
            }
        } else {

            return redirect()->intended('/index')->with('updateprofilerror', 'gagal update profil');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('/login')->with('logout', 'berhasil logout');
    }
}
