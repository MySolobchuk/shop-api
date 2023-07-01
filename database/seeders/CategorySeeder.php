<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => Str::random(10),
                'parent_id' => null,
            ],
            [
                'id' => 2,
                'name' =>  Str::random(10),
                'parent_id' => 1,
            ],
            [
                'id' => 3,
                'name' =>  Str::random(10),
                'parent_id' => 1,
            ],
            [
                'id' => 4,
                'name' =>  Str::random(10),
                'parent_id' => 1,
            ],
            [
                'id' => 5,
                'name' =>  Str::random(10),
                'parent_id' => 4,
            ],
            [
                'id' => 6,
                'name' =>  Str::random(10),
                'parent_id' => 4,
            ],
            [
                'id' => 7,
                'name' =>  Str::random(10),
                'parent_id' => 4,
            ]
        ]);
    }
}
