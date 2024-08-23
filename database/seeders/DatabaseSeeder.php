<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('categories')->insert([
            'name' => 'Laptops',
            'img_id' => '3ba4f5c3a2',
            'specifications' => '["Brand","CPU","RAM"]'
        ]);
        DB::table('categories')->insert([
            'name' => 'Monitors',
            'img_id' => 'ae5ca5b420',
            'specifications' => '["Brand","Size"]'
        ]);
      

        //convenientally generated from sql SELECT using gpt
        DB::table('products')->insert([
            [
                'name' => 'HP 15s-fq5043ne Laptop',
                'price' => 40000,
                'discounted_price' => 35999,
                'stock' => 5,
                'specifications' => json_encode([
                    ['specName' => 'Brand', 'specValue' => 'HP'],
                    ['specName' => 'CPU', 'specValue' => 'Intel i7'],
                    ['specName' => 'RAM', 'specValue' => '8 GB']
                ]),
                'category_id' => 1,
                'img_id' => '24a8edb97f',
                'created_at' => Carbon::parse('2024-08-15 17:11:36'),
                'updated_at' => Carbon::parse('2024-08-15 17:11:36'),
            ],
            [
                'name' => 'Lenovo ThinkPad E14',
                'price' => 45000,
                'discounted_price' => 42999,
                'stock' => 6,
                'specifications' => json_encode([
                    ['specName' => 'Brand', 'specValue' => 'Lenovo'],
                    ['specName' => 'CPU', 'specValue' => 'Intel i7'],
                    ['specName' => 'RAM', 'specValue' => '16 GB']
                ]),
                'category_id' => 1,
                'img_id' => '47b8fe9a32',
                'created_at' => Carbon::parse('2024-08-15 17:14:20'),
                'updated_at' => Carbon::parse('2024-08-15 17:14:20'),
            ],
            [
                'name' => 'LG Ultra Gear 27 Inch Gaming Monitor, 144Hz, Black - 27GN65R-B',
                'price' => 3000,
                'discounted_price' => 2899,
                'stock' => 5,
                'specifications' => json_encode([
                    ['specName' => 'Brand', 'specValue' => 'LG'],
                    ['specName' => 'Size', 'specValue' => '27 Inches']
                ]),
                'category_id' => 2,
                'img_id' => 'a043395293',
                'created_at' => Carbon::parse('2024-08-15 17:47:44'),
                'updated_at' => Carbon::parse('2024-08-15 17:47:44'),
            ],
            [
                'name' => 'Samsung 22 Inch FHD LED Monitor with IPS Panel, 75Hz, Black - LF22T350FHMXEG',
                'price' => 4000,
                'discounted_price' => 3699,
                'stock' => 1,
                'specifications' => json_encode([
                    ['specName' => 'Brand', 'specValue' => 'Samsung'],
                    ['specName' => 'Size', 'specValue' => '22 Inches']
                ]),
                'category_id' => 2,
                'img_id' => 'a043395293',
                'created_at' => Carbon::parse('2024-08-15 17:47:44'),
                'updated_at' => Carbon::parse('2024-08-15 17:47:44'),
            ],
        ]);
    }
}
