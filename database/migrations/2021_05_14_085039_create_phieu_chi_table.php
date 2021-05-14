<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuChiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PHIEUCHI', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('NoiDungChi');
            $table->double('TongTien');

            $table->timestamps();
            
            $table->foreignId('nhanvien_id')->constrained('NHANVIEN', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PHIEUCHI');
    }
}
