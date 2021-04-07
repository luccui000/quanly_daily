<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhanVienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NHANVIEN', function (Blueprint $table) {
            $table->string('MaNV')->unique();

            $table->string('HoTenNV', 70);
            $table->string('DienThoai', 11);
            $table->string('DiaChi', 100);
            $table->date('NgaySinh', 5);
            $table->string('GioiTinh', 5);
            $table->string('Email', 50)->nullable();
            $table->integer('TrangThai')->default(1); 
            $table->timestamps();
            
            $table->string('MaCV', 10);
            
            $table->primary('MaNV'); 
            $table->foreign('MaCV')->references('MaCV')->on('CHUCVU');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('NHANVIEN');
    }
}
