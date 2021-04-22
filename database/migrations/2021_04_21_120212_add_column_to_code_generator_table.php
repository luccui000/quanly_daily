<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCodeGeneratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CODE_GENERATOR', function (Blueprint $table) {
            $table->integer('MaPhieuNhap')->default(1);
            $table->integer('MaPhieuXuat')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('CODE_GENERATOR', function (Blueprint $table) {
            $table->dropColumn('MaPhieuNhap');
        });
    }
}
