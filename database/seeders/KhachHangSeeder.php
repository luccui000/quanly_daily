<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\KhachHang::factory(30)->create();
    }
}
