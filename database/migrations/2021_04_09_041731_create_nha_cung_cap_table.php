<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhaCungCapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NHACUNGCAP', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('MaNCC', 10)->unique(); 
            $table->string('TenNCC', 100);
            $table->string('DiaChi', 100);
            $table->string('DienThoai', 11);
            $table->string('Fax', 30)->nullable();
            $table->string('Email', 50); 
            $table->string('MaSoThue', 50);
            $table->string('SoTaiKhoan', 50); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('NHACUNGCAP');
    }
}
