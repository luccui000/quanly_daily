<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaoCaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BAOCAO', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nhanvien_id')->constrained('NHANVIEN', 'id');

            $table->string('TenBC');
            $table->string('NoiDungBC')->nullable();
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
        Schema::dropIfExists('BAOCAO');
    }
}
