<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonViTinhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DONVITINH', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('MaDVT', 10)->unique(); 
            $table->string('TenDVT', 50);
            $table->string('MoTa', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DONVITINH');
    }
}
