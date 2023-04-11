<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // $user = User::where('id_role', '2')->get();

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

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->intended('/datauser')->with('delete', 'berhasil delete');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'repassword' => 'required|same:password',
        ]);
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
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'repassword' => 'required|same:password',
        ]);
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
