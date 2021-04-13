<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhachHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KHACHHANG', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('MaKH', 10)->unique(); 
            $table->string('HoTenKH', 50); 
            $table->string('DiaChi', 100); 
            $table->string('DienThoai', 11); 
            $table->string('Email', 50)->nullable(); 
            $table->string('SoTaiKhoan', 50); 
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
        Schema::dropIfExists('KHACHHANG');
    }
}
