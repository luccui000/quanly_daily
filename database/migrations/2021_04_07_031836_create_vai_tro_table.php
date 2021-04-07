<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaiTroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('VAITRO', function (Blueprint $table) {
            $table->string('MaVT', 10)->unique();
            $table->string('TenVT', 50);
            $table->string('MoTa', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('VAITRO', function (Blueprint $table) {
            //
        });
    }
}
