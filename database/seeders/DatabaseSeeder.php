<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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

        User::create([
            'name' => 'Ilham Ibnu Ahmad',
            'username' => 'ilhamibnu',
            'password' => bcrypt('admin'),
            'email' => 'admin@gmail.com',
            'id_role' => '1'
        ]);
    }
}
