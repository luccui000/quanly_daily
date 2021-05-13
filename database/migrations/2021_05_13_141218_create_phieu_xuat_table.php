<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuXuatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PHIEUXUAT', function (Blueprint $table) {
            $table->bigIncrements('id');  
            $table->string('MoTa', 255);
            $table->double('TongTien');
            $table->double('TongVAT');
            $table->double('TongChietKhau');
            $table->double('TongThanhToan');
            $table->integer('HinhThucThanhToan');
            $table->integer('TrangThai');
            $table->timestamps();

            $table->foreignId('nhanvien_id')->constrained('NHANVIEN', 'id');
            $table->foreignId('kho_id')->constrained('KHO', 'id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PHIEUXUAT');
    }
}
