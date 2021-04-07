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
            $table->string('TenDangNhap', 10);
            $table->foreign('TenDangNhap')->references('TenDangNhap')->on('NGUOIDUNG');
            $table->string('MaVT', 10);
            $table->foreign('MaVT')->references('MaVT')->on('VAITRO');
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
