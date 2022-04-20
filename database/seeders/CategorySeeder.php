<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // if (DB::table('categories')->count() == 0) {
        //     $data = [
        //         [
        //             'name' => 'CONVERSE',
        //             'slug' => 'converse',
        //         ],
        //         [
        //             'name' => 'VANS',
        //             'slug' => 'vans',
        //         ],
        //         [
        //             'name' => 'ACCESSORIES',
        //             'slug' => 'accessories',
        //         ],
        //         [
        //             'name' => 'APPAREL',
        //             'slug' => 'apparel',
        //         ]
        //     ];

        //     DB::table('categories')->insert($data);
        // }

        Category::factory()->count(100)->create();
    }
}
