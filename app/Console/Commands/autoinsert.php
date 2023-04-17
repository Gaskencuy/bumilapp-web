<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class autoinsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert data detail pengingat';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $datauser = DB::table('users')
            ->where('id_role', 2)
            ->get();

        $datapengingat = DB::table('pengingat')->get();
        foreach ($datauser as $user) {
            foreach ($datapengingat as $pengingat) {
                DB::table('detail_pengingat')->insert([
                    'id_user' => $user->id,
                    'id_pengingat' => $pengingat->id,
                    'status' => 'belum',
                    'tanggal' => date('Y-m-d'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        return 0;
    }
}
