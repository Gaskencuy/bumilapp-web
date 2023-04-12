<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datapoli', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemeriksa');
            $table->text('ttd_pemeriksa');
            $table->text('bukti_pemeriksaan');
            $table->string('tempat');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datapoli');
    }
};
