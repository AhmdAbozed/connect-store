<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'img_id' => '21add7b27a',
            'specifications' => '["Hard Disk","CPU","RAM"]'
        ]);
        DB::table('categories')->insert([
            'name' => 'Monitors',
            'img_id' => '981bed7f82',
            'specifications' => '["Display Size","Resolution"]'
        ]);
        DB::table('brands')->insert([
            'name' => 'lenovo'
        ]);
        DB::table('brands')->insert([
            'name' => 'samsung'
        ]);

        DB::table('brands')->insert([
            'name' => 'LG'
        ]);
        DB::table('brands')->insert([
            'name' => 'HP'
        ]);

        //convenientally generated from sql SELECT using gpt
        DB::table('products')->insert([
            [
                'name' => 'Lenovo ThinkPad E14',
                'price' => 31999,
                'discounted_price' => 29999,
                'stock' => 2,
                'specifications' => json_encode([
                    ['specName' => 'CPU', 'specValue' => 'AMD'],
                    ['specName' => 'RAM', 'specValue' => '8 GB'],
                    ['specName' => 'Hard Disk', 'specValue' => '512GB SSD']
                ]),
                'category_id' => 1,
                'brand_id' => 1,
                'img_id' => 'feb7239203',
                'created_at' => '2024-07-31 17:54:15',
                'updated_at' => '2024-07-31 17:54:15',
            ],
            [
                'name' => 'something something',
                'price' => 31999,
                'discounted_price' => 29999,
                'stock' => 2,
                'specifications' => json_encode([
                    ['specName' => 'CPU', 'specValue' => 'Intel'],
                    ['specName' => 'RAM', 'specValue' => '8 GB'],
                    ['specName' => 'Hard Disk', 'specValue' => '1TB SSD']
                ]),
                'category_id' => 1,
                'brand_id' => 1,
                'img_id' => 'feb7239203',
                'created_at' => '2024-07-31 17:54:15',
                'updated_at' => '2024-07-31 17:54:15',
            ],
            [
                'name' => 'HP 15s-fq5043ne Laptop',
                'price' => 38999,
                'discounted_price' => 31999,
                'stock' => 5,
                'specifications' => json_encode([
                    ['specName' => 'RAM', 'specValue' => '16 GB'],
                    ['specName' => 'CPU', 'specValue' => 'Intel'],
                    ['specName' => 'Hard Disk', 'specValue' => '512GB SSD']
                ]),
                'category_id' => 1,
                'brand_id' => 1,
                'img_id' => '9a10e67fa3',
                'created_at' => '2024-07-31 17:42:27',
                'updated_at' => '2024-07-31 17:42:27',
            ],
            [
                'name' => 'LG Ultra Gear 27 Inch Gaming Monitor, 144Hz, Black - 27GN65R-B',
                'price' => 10060,
                'discounted_price' => 8799,
                'stock' => 1,
                'specifications' => json_encode([
                    ['specName' => 'Resolution Type', 'specValue' => 'FHD (1920 X 1080), 1ms IPS Anti-Glare'],
                    ['specName' => 'Aspect Ratio', 'specValue' => '16:9'],
                    ['specName' => 'Display Size', 'specValue' => '27 Inch, 144Hz']
                ]),
                'category_id' => 2,
                'brand_id' => 3,
                'img_id' => '981bed7f82',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung 22 Inch FHD LED Monitor with IPS Panel, 75Hz, Black - LF22T350FHMXEG',
                'price' => 3549,
                'discounted_price' => 3070,
                'stock' => 2,
                'specifications' => json_encode([
                    ['specName' => 'Monitor Type', 'specValue' => 'Curved Monitor'],
                    ['specName' => 'Size in Inch', 'specValue' => '22 Inch with 75Hz refresh rate']
                ]),
                'category_id' => 2,
                'brand_id' => 2,
                'img_id' => 'a2b2c80ab5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
