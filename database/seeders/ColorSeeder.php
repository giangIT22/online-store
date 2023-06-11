<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('colors')->count() == 0) {
            $data = [
                [
                    'name' => 'Đen'
                ],
                [
                    'name' => 'Trắng'
                ],
                [
                    'name' => 'Xám'
                ],
                [
                    'name' => 'Vàng'
                ],
                [
                    'name' => 'Đỏ'
                ],
                [
                    'name' => 'Nâu'
                ],
                [
                    'name' => 'Cam'
                ]
            ];

            DB::table('colors')->insert($data);
        }
    }
}
