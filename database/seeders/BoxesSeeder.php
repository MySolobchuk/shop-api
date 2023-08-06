<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boxes')->insert([
            [
                'id' => 1,
                'title' => 'small',
                'size' => 10,
                'price' => 10.00,
                'delivery_id' => 1
            ],
            [
                'id' => 2,
                'title' => 'medium',
                'size' => 100,
                'price' => 20.00,
                'delivery_id' => 1
            ],
            [
                'id' => 3,
                'title' => 'large',
                'size' => 1000,
                'price' => 30.00,
                'delivery_id' => 1
            ]
        ]);
    }
}
