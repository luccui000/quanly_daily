<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\NguoiDung::factory(100)->create();
    }
}
