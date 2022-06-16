<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('sizes')->count() == 0) {
            $data = [
                [
                    'name' => 'Size 6.5US - Size 39.5VN - 25.0CM'
                ],
                [
                    'name' => 'Size 7.0US - Size 40.0VN - 25.5CM'
                ],
                [
                    'name' => 'Size 7.5US - Size 41.0VN - 26.0CM'
                ],
                [
                    'name' => 'Size 8.0US - Size 41.5VN - 26.5CM'
                ],
                [
                    'name' => 'Size 8.5US - Size 42.0VN - 27.0CM'
                ],
                [
                    'name' => 'Size 9.0US - Size 42.5VN - 27.5CM'
                ],
                [
                    'name' => 'Size 9.5US - Size 43.0VN - 28.0CM'
                ]
            ];

            DB::table('sizes')->insert($data);
        }
    }
}
