<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuNhapHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PHIEUNHAP', function (Blueprint $table) {  
            $table->integer('SoLuong');
            $table->double('DonGia');
            $table->double('ThanhTien');
            $table->double('PT_ChietKhau');
            $table->double('PT_VAT');

            $table->foreignId('mathang_id')->constrained('MATHANG', 'id')->onDelete('cascade');
            $table->foreignId('phieuhang_id')->constrained('PHIEUHANG', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PHIEUNHAP');
    }
}
