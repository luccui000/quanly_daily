<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHinhAnhColumnToMatHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('MATHANG', function (Blueprint $table) {
            $table->string('HinhAnh')->default('default-img.png');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('MATHANG', function (Blueprint $table) {
            $table->dropColumn('HinhAnh');
        });
    }
}
