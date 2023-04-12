<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DetailPengingat;
use App\Models\Pengingat;

class DetailPengingatController extends Controller
{

    public function index()
    {
        $datauser = User::with(['role'])
            ->where('id_role', 2)
            ->get();

        $datapengingat = Pengingat::all();

        $detailpengingat = DetailPengingat::with(['user', 'pengingat'])
            ->get();

        return view(
            'pages.datapengingat',
            [
                'dataDetailPengingat' => $detailpengingat,
                'dataUser' => $datauser,
                'dataPengingat' => $datapengingat,
            ]
        );
    }

    public function create(Request $request)
    {
        $detailpengingat = new DetailPengingat();

        $detailpengingat->id_user = $request->id_user;
        $detailpengingat->id_pengingat = $request->id_pengingat;
        $detailpengingat->status = $request->status;
        $detailpengingat->tanggal = $request->tanggal;
        $detailpengingat->save();

        return redirect('/datapengingat')->with('create', 'berhasil create');
    }

    public function update(Request $request, $id)
    {
        $detailpengingat = DetailPengingat::find($id);
        $detailpengingat->id_user = $request->id_user;
        $detailpengingat->id_pengingat = $request->id_pengingat;
        $detailpengingat->status = $request->status;
        $detailpengingat->tanggal = $request->tanggal;
        $detailpengingat->save();

        return redirect('/datapengingat')->with('update', 'berhasil update');
    }

    public function delete($id)
    {
        $detailpengingat = DetailPengingat::find($id);
        $detailpengingat->delete();

        return redirect('/datapengingat')->with('delete', 'berhasil delete');
    }
}
