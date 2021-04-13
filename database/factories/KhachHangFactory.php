<?php

namespace Database\Factories;

use App\Models\KhachHang;
use Illuminate\Database\Eloquent\Factories\Factory;

class KhachHangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KhachHang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'MaKH' => 'KH'. $this->faker->numberBetween(1000, 9999),
            'HoTenKH' => $this->faker->name(),
            'DiaChi' => $this->faker->address,
            'DienThoai' => '039'. $this->faker->numberBetween(1000000, 9999999),
            'Email' => $this->faker->unique()->safeEmail,
            'SoTaiKhoan' => $this->faker->bankAccountNumber
        ];
    }
}
