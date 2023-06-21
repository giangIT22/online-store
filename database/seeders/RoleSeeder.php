<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('roles')->count() == 0) {
            $data = [
                [
                    'name' => 'Admin'
                ],
                [
                    'name' => 'Employee'
                ],
            ];

            DB::table('roles')->insert($data);
        }
    }
}
