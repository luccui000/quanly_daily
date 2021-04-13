<?php

namespace Database\Factories;

use App\Models\NhanVien;
use Illuminate\Database\Eloquent\Factories\Factory;

class NhanVienFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NhanVien::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $prefix = ['NV', 'QL', 'TK', 'GH', 'VP'];
        $gioitinh = ['Nam', 'Nữ'];

        return [
            'MaNV' => $prefix[$this->faker->numberBetween(0, 4)] .$this->faker->numberBetween(0, 1000),
            'HoTenNV' => $this->faker->name,
            'DienThoai' => '039'.$this->faker->numberBetween(1000000, 9999999),
            'DiaChi' => $this->faker->address,
            'NgaySinh' => $this->faker->date,
            'GioiTinh' => $gioitinh[$this->faker->numberBetween(0, 1)],
            'Email' => $this->faker->email,
            'TrangThai' => $this->faker->numberBetween(0, 1),
            'chucvu_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
