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
        $request->validate(
            [
                'id_user' => 'required',
                'nama_pemeriksa' => 'required|max:30',
                'ttd_pemeriksa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'bukti_pemeriksaan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'tempat' => 'required|max:30',
                'tanggal' => 'required|date',
            ],
            [
                'id_user.required' => 'Nama User tidak boleh kosong',
                'nama_pemeriksa.required' => 'Nama Pemeriksa tidak boleh kosong',
                'nama_pemeriksa.max' => 'Nama Pemeriksa maksimal 30 karakter',
                'ttd_pemeriksa.required' => 'TTD Pemeriksa tidak boleh kosong',
                'ttd_pemeriksa.image' => 'TTD Pemeriksa harus berupa gambar',
                'ttd_pemeriksa.mimes' => 'TTD Pemeriksa harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
                'ttd_pemeriksa.max' => 'TTD Pemeriksa maksimal 2 MB',
                'bukti_pemeriksaan.required' => 'Bukti Pemeriksaan tidak boleh kosong',
                'bukti_pemeriksaan.image' => 'Bukti Pemeriksaan harus berupa gambar',
                'bukti_pemeriksaan.mimes' => 'Bukti Pemeriksaan harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
                'bukti_pemeriksaan.max' => 'Bukti Pemeriksaan maksimal 2 MB',
                'tempat.required' => 'Tempat tidak boleh kosong',
                'tempat.max' => 'Tempat maksimal 30 karakter',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'tanggal.date' => 'Tanggal harus berupa tanggal',
            ],
        );

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

            $request->validate(
                [
                    'id_user' => 'required',
                    'nama_pemeriksa' => 'required|max:30',
                    'tempat' => 'required|max:30',
                    'tanggal' => 'required|date',
                ],
                [
                    'id_user.required' => 'Nama User tidak boleh kosong',
                    'nama_pemeriksa.required' => 'Nama Pemeriksa tidak boleh kosong',
                    'nama_pemeriksa.max' => 'Nama Pemeriksa maksimal 30 karakter',
                    'tempat.required' => 'Tempat tidak boleh kosong',
                    'tempat.max' => 'Tempat maksimal 30 karakter',
                    'tanggal.required' => 'Tanggal tidak boleh kosong',
                    'tanggal.date' => 'Tanggal harus berupa tanggal',
                ],
            );


            $datapoli = DataPoli::find($id);
            $datapoli->id_user = $request->id_user;
            $datapoli->nama_pemeriksa = $request->nama_pemeriksa;
            $datapoli->tempat = $request->tempat;
            $datapoli->tanggal = $request->tanggal;
            $datapoli->save();
        } elseif ($request->ttd_pemeriksa == null) {

            $request->validate(
                [
                    'id_user' => 'required',
                    'nama_pemeriksa' => 'required|max:30',
                    'bukti_pemeriksaan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'tempat' => 'required|max:30',
                    'tanggal' => 'required|date',
                ],
                [
                    'id_user.required' => 'Nama User tidak boleh kosong',
                    'nama_pemeriksa.required' => 'Nama Pemeriksa tidak boleh kosong',
                    'nama_pemeriksa.max' => 'Nama Pemeriksa maksimal 30 karakter',
                    'bukti_pemeriksaan.required' => 'Bukti Pemeriksaan tidak boleh kosong',
                    'bukti_pemeriksaan.image' => 'Bukti Pemeriksaan harus berupa gambar',
                    'bukti_pemeriksaan.mimes' => 'Bukti Pemeriksaan harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
                    'bukti_pemeriksaan.max' => 'Bukti Pemeriksaan maksimal 2 MB',
                    'tempat.required' => 'Tempat tidak boleh kosong',
                    'tempat.max' => 'Tempat maksimal 30 karakter',
                    'tanggal.required' => 'Tanggal tidak boleh kosong',
                    'tanggal.date' => 'Tanggal harus berupa tanggal',
                ],
            );

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

            $request->validate(
                [
                    'id_user' => 'required',
                    'nama_pemeriksa' => 'required|max:30',
                    'ttd_pemeriksa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'tempat' => 'required|max:30',
                    'tanggal' => 'required|date',
                ],
                [
                    'id_user.required' => 'Nama User tidak boleh kosong',
                    'nama_pemeriksa.required' => 'Nama Pemeriksa tidak boleh kosong',
                    'nama_pemeriksa.max' => 'Nama Pemeriksa maksimal 30 karakter',
                    'ttd_pemeriksa.required' => 'TTD Pemeriksa tidak boleh kosong',
                    'ttd_pemeriksa.image' => 'TTD Pemeriksa harus berupa gambar',
                    'ttd_pemeriksa.mimes' => 'TTD Pemeriksa harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
                    'ttd_pemeriksa.max' => 'TTD Pemeriksa maksimal 2 MB',
                    'tempat.required' => 'Tempat tidak boleh kosong',
                    'tempat.max' => 'Tempat maksimal 30 karakter',
                    'tanggal.required' => 'Tanggal tidak boleh kosong',
                    'tanggal.date' => 'Tanggal harus berupa tanggal',
                ],
            );

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

            $request->validate(
                [
                    'id_user' => 'required',
                    'nama_pemeriksa' => 'required|max:30',
                    'ttd_pemeriksa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'bukti_pemeriksaan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'tempat' => 'required|max:30',
                    'tanggal' => 'required|date',
                ],
                [
                    'id_user.required' => 'Nama User tidak boleh kosong',
                    'nama_pemeriksa.required' => 'Nama Pemeriksa tidak boleh kosong',
                    'nama_pemeriksa.max' => 'Nama Pemeriksa maksimal 30 karakter',
                    'ttd_pemeriksa.required' => 'TTD Pemeriksa tidak boleh kosong',
                    'ttd_pemeriksa.image' => 'TTD Pemeriksa harus berupa gambar',
                    'ttd_pemeriksa.mimes' => 'TTD Pemeriksa harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
                    'ttd_pemeriksa.max' => 'TTD Pemeriksa maksimal 2 MB',
                    'bukti_pemeriksaan.required' => 'Bukti Pemeriksaan tidak boleh kosong',
                    'bukti_pemeriksaan.image' => 'Bukti Pemeriksaan harus berupa gambar',
                    'bukti_pemeriksaan.mimes' => 'Bukti Pemeriksaan harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
                    'bukti_pemeriksaan.max' => 'Bukti Pemeriksaan maksimal 2 MB',
                    'tempat.required' => 'Tempat tidak boleh kosong',
                    'tempat.max' => 'Tempat maksimal 30 karakter',
                    'tanggal.required' => 'Tanggal tidak boleh kosong',
                    'tanggal.date' => 'Tanggal harus berupa tanggal',
                ],
            );

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
