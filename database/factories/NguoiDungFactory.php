<?php

namespace Database\Factories;

use App\Models\NguoiDung;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class NguoiDungFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NguoiDung::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'TenDangNhap' => $this->faker->unique()->userName,
            'MatKhau' => Hash::make($this->faker->password),
            'LanDangNhapCuoi' => \Carbon\Carbon::now(),
            'TrangThai' => $this->faker->numberBetween(0, 1)
        ];
    }
}
