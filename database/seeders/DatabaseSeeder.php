<?php

namespace Database\Seeders;

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
                'nama' => 'Gosok Gigi Siang',
            ],

        );
        Pengingat::create(
            [
                'time' => '19:00:00',
                'nama' => 'Gosok Gigi Malam',
            ],

        );
    }
}
