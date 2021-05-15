<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietPhieuXuatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CHITIET_PHIEUXUAT', function (Blueprint $table) {
            $table->id();
            $table->integer('LoaiPhieu')->default(0);
            
            $table->foreignId('mathang_id')->constrained('MATHANG', 'id');
            $table->foreignId('phieuxuat_id')->constrained('PHIEUXUAT', 'id');

            $table->integer('SoLuong');
            $table->double('DonGia');
            $table->double('ThanhTien');
            $table->double('TienChietKhau');
            $table->double('TienVAT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CHITIET_PHIEUXUAT');
    }
}
