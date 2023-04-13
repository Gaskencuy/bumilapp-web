<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DataPoli;
use App\Models\DetailPengingat;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with(['role'])
            ->where('id_role', '2')
            ->get();

        return view(
            'pages.datauser',
            [
                'userList' => $user,
            ]
        );
    }

    public function detailuser($id)
    {
        $detailpengingat = DetailPengingat::with(['user', 'pengingat'])
            ->where('id_user', $id)
            ->get();

        $detailpoli = DataPoli::with(['user'])
            ->where('id_user', $id)
            ->get();

        $user = User::find($id);

        return view(
            'pages.datauser-detail',
            [
                'detailpengingat' => $detailpengingat,
                'detailpoli' => $detailpoli,
                'user' => $user,
            ],
        );
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->intended('/datauser')->with('delete', 'berhasil delete');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:30',
                'email' => 'required|unique:users,email,' . $id . '|max:30',
                'username' => 'max:30|regex:/^\S*$/u|alpha_dash|unique:users,username,' . $id,
                'password' => 'required|max:30',
                'repassword' => 'required|same:password|max:30',
            ],
            [
                'name' => 'name harus diisi',
                'name.max' => 'name maksimal 30 karakter',
                'username.required' => 'username harus diisi',
                'username.unique' => 'username sudah ada',
                'username.max' => 'username maksimal 30 karakter',
                'username.regex' => 'username tidak boleh ada spasi',
                'username.alpha_dash' => 'username tidak boleh ada spasi',
                'email.required' => 'email harus diisi',
                'email.unique' => 'email sudah ada',
                'email.max' => 'email maksimal 30 karakter',
                'password.required' => 'password harus diisi',
                'password.max' => 'password maksimal 30 karakter',
                'repassword.required' => 'repassword harus diisi',
                'repassword.same' => 'repassword harus sama dengan password',
            ],

        );
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->intended('/datauser')->with('update', 'berhasil update');
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:30',
                'email' => 'required|unique:users,email|max:30',
                'username' => 'max:30|regex:/^\S*$/u|alpha_dash|unique:users,username,',
                'password' => 'required|max:30',
                'repassword' => 'required|same:password|max:30',
            ],
            [
                'name' => 'name harus diisi',
                'name.max' => 'name maksimal 30 karakter',
                'username.required' => 'username harus diisi',
                'username.unique' => 'username sudah ada',
                'username.max' => 'username maksimal 30 karakter',
                'username.regex' => 'username tidak boleh ada spasi',
                'username.alpha_dash' => 'username tidak boleh ada spasi',
                'email.required' => 'email harus diisi',
                'email.unique' => 'email sudah ada',
                'email.max' => 'email maksimal 30 karakter',
                'password.required' => 'password harus diisi',
                'password.max' => 'password maksimal 30 karakter',
                'repassword.required' => 'repassword harus diisi',
                'repassword.same' => 'repassword harus sama dengan password',
            ],

        );
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_role = '2';
        $user->save();
        return redirect()->intended('/datauser')->with('create', 'berhasil create');
    }
}
