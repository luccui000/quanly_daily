<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MATHANG', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('MaMH')->unique();
            $table->string('TenMH', 100);  
            $table->string('ThongSo', 500);
            $table->string('BaoHanh', 50);
            $table->double('GiaNhap');
            $table->double('GiaXuat');
            $table->tinyInteger('TrangThai')->default(1);

            $table->foreignId('loaimathang_id')->constrained('LOAIMATHANG', 'id');
            $table->foreignId('donvitinh_id')->constrained('DONVITINH', 'id');
            $table->foreignId('nhacungcap_id')->constrained('NHACUNGCAP', 'id');
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
        Schema::dropIfExists('MATHANG');
    }
}
