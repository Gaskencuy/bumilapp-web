<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DataPoli;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class DataPoliController extends Controller
{
    public function index()
    {
        $datapoli = DataPoli::with(['user'])
            ->get();

        $datauser = User::with(['role'])
            ->where('id_role', 2)
            ->get();

        return view(
            'pages.datapoli',
            [
                'dataPoli' => $datapoli,
                'dataUser' => $datauser,
            ]
        );
    }


    public function create(Request $request)
    {
        $datapoli = new DataPoli();

        $fileNameTTD = time() . '.' . $request->ttd_pemeriksa->extension();
        $request->ttd_pemeriksa->move(public_path('foto/ttd/'), $fileNameTTD);

        $fileNameBukti = time() . '.' . $request->bukti_pemeriksaan->extension();
        $request->bukti_pemeriksaan->move(public_path('foto/bukti/'), $fileNameBukti);

        $datapoli->id_user = $request->id_user;
        $datapoli->nama_pemeriksa = $request->nama_pemeriksa;
        $datapoli->ttd_pemeriksa = $fileNameTTD;
        $datapoli->bukti_pemeriksaan = $fileNameBukti;
        $datapoli->tempat = $request->tempat;
        $datapoli->tanggal = $request->tanggal;
        $datapoli->save();

        return redirect('/datapoli')->with('create', 'berhasil create');
    }


    public function update(Request $request, $id)
    {
        if ($request->ttd_pemeriksa == null && $request->bukti_pemeriksaan == null) {

            $datapoli = DataPoli::find($id);
            $datapoli->id_user = $request->id_user;
            $datapoli->nama_pemeriksa = $request->nama_pemeriksa;
            $datapoli->tempat = $request->tempat;
            $datapoli->tanggal = $request->tanggal;
            $datapoli->save();
        } elseif ($request->ttd_pemeriksa == null) {

            $update = DataPoli::where('id', $id)->first();
            File::delete(public_path('foto/bukti') . '/' . $update->bukti_pemeriksaan);

            $fileNameBukti = time() . '.' . $request->bukti_pemeriksaan->extension();
            $request->bukti_pemeriksaan->move(public_path('foto/bukti/'), $fileNameBukti);

            $datapoli = DataPoli::find($id);
            $datapoli->id_user = $request->id_user;
            $datapoli->nama_pemeriksa = $request->nama_pemeriksa;
            $datapoli->bukti_pemeriksaan = $fileNameBukti;
            $datapoli->tempat = $request->tempat;
            $datapoli->tanggal = $request->tanggal;
            $datapoli->save();
        } elseif ($request->bukti_pemeriksaan == null) {

            $update = DataPoli::where('id', $id)->first();
            File::delete(public_path('foto/ttd') . '/' . $update->ttd_pemeriksa);

            $fileNameTTD = time() . '.' . $request->ttd_pemeriksa->extension();
            $request->ttd_pemeriksa->move(public_path('foto/ttd/'), $fileNameTTD);

            $datapoli = DataPoli::find($id);
            $datapoli->id_user = $request->id_user;
            $datapoli->nama_pemeriksa = $request->nama_pemeriksa;
            $datapoli->ttd_pemeriksa = $fileNameTTD;
            $datapoli->tempat = $request->tempat;
            $datapoli->tanggal = $request->tanggal;
            $datapoli->save();
        } else {

            $updatettd = DataPoli::where('id', $id)->first();
            File::delete(public_path('foto/ttd') . '/' . $updatettd->ttd_pemeriksa);

            $updatebukti = DataPoli::where('id', $id)->first();
            File::delete(public_path('foto/bukti') . '/' . $updatebukti->bukti_pemeriksaan);

            $fileNameTTD = time() . '.' . $request->ttd_pemeriksa->extension();
            $request->ttd_pemeriksa->move(public_path('foto/ttd/'), $fileNameTTD);

            $fileNameBukti = time() . '.' . $request->bukti_pemeriksaan->extension();
            $request->bukti_pemeriksaan->move(public_path('foto/bukti/'), $fileNameBukti);

            $datapoli = DataPoli::find($id);
            $datapoli->id_user = $request->id_user;
            $datapoli->nama_pemeriksa = $request->nama_pemeriksa;
            $datapoli->ttd_pemeriksa = $fileNameTTD;
            $datapoli->bukti_pemeriksaan = $fileNameBukti;
            $datapoli->tempat = $request->tempat;
            $datapoli->tanggal = $request->tanggal;
            $datapoli->save();
        }



        return redirect('/datapoli')->with('update', 'berhasil update');
    }

    public function delete($id)
    {
        $updatettd = DataPoli::where('id', $id)->first();
        File::delete(public_path('foto/ttd') . '/' . $updatettd->ttd_pemeriksa);

        $updatebukti = DataPoli::where('id', $id)->first();
        File::delete(public_path('foto/bukti') . '/' . $updatebukti->bukti_pemeriksaan);

        $datapoli = DataPoli::find($id);
        $datapoli->delete();

        return redirect('/datapoli')->with('delete', 'berhasil delete');
    }
}
