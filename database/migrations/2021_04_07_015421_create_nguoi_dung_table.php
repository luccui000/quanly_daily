<?php

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNguoiDungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NGUOIDUNG', function (Blueprint $table) { 
            $table->bigIncrements('id');
            $table->string('TenDangNhap', 30)->unique(); 
            
            $table->string('MatKhau', 255); 
            $table->dateTime('LanDangNhapCuoi');
            $table->integer('TrangThai')->default(1);

            $table->foreignId('nhanvien_id')->nullable()->constrained('NHANVIEN', 'id');
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
        Schema::dropIfExists('NGUOIDUNG');
    }
}
