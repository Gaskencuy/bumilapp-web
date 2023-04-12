<?php

namespace App\Http\Controllers;

use App\Models\Pengingat;
use Illuminate\Http\Request;

class PengingatController extends Controller
{
    public function index()
    {
        $items = Pengingat::all();
        return view('pages.pengingat', ['itemList' => $items]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'time' => 'required',
                'name' => 'required|max:30',
            ],
            [
                'time.required' => 'time harus diisi',
                'name.required' => 'name harus diisi',
                'name.max' => 'name maksimal 30 karakter',
            ],
        );

        $item = Pengingat::find($id);
        $item->time = $request->time;
        $item->name = $request->name;
        $item->save();
        return redirect()->intended('/pengingat')->with('update', 'berhasil update');
    }

    public function delete($id)
    {
        $item = Pengingat::find($id);
        $item->delete();
        return redirect()->intended('/pengingat')->with('delete', 'berhasil delete');
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'time' => 'required',
                'name' => 'required|max:30',
            ],
            [
                'time.required' => 'time harus diisi',
                'name.required' => 'name harus diisi',
                'name.max' => 'name maksimal 30 karakter',
            ],
        );

        $item = new Pengingat();
        $item->time = $request->time;
        $item->name = $request->name;
        $item->save();
        return redirect()->intended('/pengingat')->with('create', 'berhasil create');
    }
}
