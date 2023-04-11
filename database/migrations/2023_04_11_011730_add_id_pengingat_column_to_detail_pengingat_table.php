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
        Schema::table('detail_pengingat', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengingat')->after('id')->default(2);
            $table->foreign('id_pengingat')->references('id')->on('pengingat')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_pengingat', function (Blueprint $table) {
            $table->dropForeign(['id_pengingat']);
            $table->dropColumn('id_pengingat');
        });
    }
};
