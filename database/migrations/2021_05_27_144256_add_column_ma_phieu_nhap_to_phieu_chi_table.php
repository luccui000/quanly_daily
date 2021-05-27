<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMaPhieuNhapToPhieuChiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('PHIEUCHI', function (Blueprint $table) {
            $table->foreignId('mapn_id')->nullable()->constrained('PHIEUHANG', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('PHIEUCHI', function (Blueprint $table) {
            $table->dropColumn('mapn_id');
        });
    }
}
