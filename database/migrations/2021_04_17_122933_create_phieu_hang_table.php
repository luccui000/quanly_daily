<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PHIEUHANG', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaPH', 10);
            $table->date('NgayLap');
            $table->string('MoTa', 255);
            $table->double('TongTien');
            $table->double('Tong_VAT');
            $table->double('Tong_ChietKhau');
            $table->double('TongThanhToan');
            $table->integer('HinhThucThanhToan');
            $table->integer('TrangThai');
            $table->timestamps();

            $table->foreignId('nhanvien_id')->constrained('NHANVIEN', 'id');
            $table->foreignId('kho_id')->constrained('KHO', 'id');
            $table->foreignId('nhacungcap_id')->constrained('NHACUNGCAP', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PHIEUHANG');
    }
}
