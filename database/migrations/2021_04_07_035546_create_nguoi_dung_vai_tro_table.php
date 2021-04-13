<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNguoiDungVaiTroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NGUOIDUNG_VAITRO', function (Blueprint $table) { 
            $table->foreignId('nguoidung_id')->constrained('NGUOIDUNG', 'id'); 
            $table->foreignId('vaitro_id')->constrained('VAITRO', 'id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('NGUOIDUNG_VAITRO');
    }
}
