<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\NhanVien::factory(10)->create();
    }
}
