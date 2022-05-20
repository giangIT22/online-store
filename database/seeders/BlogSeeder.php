<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('blogs')->count() == 0) {
            $data = [
                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 2',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 3',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 4',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],
                [
                    'title' => 'bai viet 5',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ],                [
                    'title' => 'bai viet 1',
                    'slug' => 'bai-viet-1',
                    'post_image' => 'asdasd',
                    'content' => 'asdasdasdasd'
                ]
            ];

            DB::table('blogs')->insert($data);
        }
    }
}
