<?php

namespace Database\Seeders;

use App\Models\DataPoli;
use App\Models\DetailPengingat;
use App\Models\Pengingat;
use App\Models\Role;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'user'
        ]);

        User::create(

            [
                'name' => 'Ilham Ibnu Ahmad',
                'username' => 'ilhamibnu',
                'password' => bcrypt('admin'),
                'email' => 'admin@gmail.com',
                'id_role' => '1',
            ],

        );

        User::create(
            [

                'name' => 'Rizki Ramadhan',
                'username' => 'rizki',
                'password' => bcrypt('user'),
                'email' => 'rizki@gmail.com',
                'id_role' => '2',
            ],

        );

        User::create(
            [
                'name' => 'Akbar Kusnadi',
                'username' => 'akbar',
                'password' => bcrypt('user'),
                'email' => 'akbar@gmail.com',
                'id_role' => '2',
            ],

        );

        Pengingat::create(
            [
                'time' => '10:00:00',
                'name' => 'Gosok Gigi Siang',
            ],

        );
        Pengingat::create(
            [
                'time' => '19:00:00',
                'name' => 'Gosok Gigi Malam',
            ],

        );

        DataPoli::create(
            [
                'id_user' => '2',
                'nama_pemeriksa' => 'dr. Rijal Ramadhan',
                'ttd_pemeriksa' => 'ttd1.jpeg',
                'bukti_pemeriksaan' => 'bukti1.jpeg',
                'tempat' => 'RS. Islam',
                'tanggal' => '2022-05-01',

            ],

        );

        DataPoli::create(
            [
                'id_user' => '3',
                'nama_pemeriksa' => 'dr. Achmad Zakariya',
                'ttd_pemeriksa' => 'ttd2.png',
                'bukti_pemeriksaan' => 'bukti2.jpeg',
                'tempat' => 'RS. Kristen',
                'tanggal' => '2022-05-01',

            ],

        );

        DetailPengingat::create(
            [
                'id_pengingat' => '1',
                'id_user' => '2',
                'status' => 'belum',
                'tanggal' => '2022-05-01',
            ],

        );

        DetailPengingat::create(
            [
                'id_pengingat' => '2',
                'id_user' => '3',
                'status' => 'belum',
                'tanggal' => '2022-05-01',
            ],

        );
    }
}
