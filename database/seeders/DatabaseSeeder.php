<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        // $this->call(NguoiDungSeeder::class);
        // $this->call(NhanVienSeeder::class);
        $this->call(KhachHangSeeder::class);
    }
}
