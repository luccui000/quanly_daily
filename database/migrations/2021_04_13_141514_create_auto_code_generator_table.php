<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoCodeGeneratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CODE_GENERATOR', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('MaNhanVien')->default(1);
            $table->integer('MaQuanLy')->default(1);
            $table->integer('MaThuKhu')->default(1);
            $table->integer('MaVanPhong')->default(1);
            $table->integer('MaKhachHang')->default(1);
            $table->integer('MaNhaCungCap')->default(1);
            $table->integer('MaMatHang')->default(1);
            $table->integer('MaHoaDon')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CODE_GENERATOR');
    }
}
