<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecuritySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([

            [
                'name' => 'Surveillance & Security',
                'img_id' => '537804591c',
            ],
            
        ]);

        DB::table('subcategories')->insert([
            [
                'name' => 'Video Recorders',
                'img_id' => '3ebd7d6597',
                'category_id' => 1,
                'specifications' => json_encode([ "Type", "Channels", "Resolution"]),
            ],
            [
                'name' => 'Security Cameras',
                'img_id' => '759923d1c7',
                'category_id' => 1,
                'specifications' => json_encode([ "Type", "Voltage", "Wattage", "Resolution"]),
            ],
            [
                'name' => 'PDUs',
                'img_id' => 'eb9fb76f71',
                'category_id' => 1,
                'specifications' => json_encode(["Voltage", "Wattage"])
            ],
           
            [
                'name' => 'Cables',
                'img_id' => '184aae9993',
                'category_id' => 1,
                'specifications' => json_encode(["Length", "Type"]),
            ],
            [
                'name' => 'Surveillance Accessories',
                'img_id' => '57e0f9914c',
                'category_id' => 1,
                'specifications' => json_encode(["Type"]),
            ]
            
        ]);


        DB::table('products')->insert([
            [
                'name' => 'High-end Power supply 24V/10A',
                'price' => 2000,
                'discounted_price' => 1100,
                'stock' => 5,
                'specifications' => json_encode([
                    ["specName" => "Voltage", "specValue" => "24V"],
                    ["specName" => "Wattage", "specValue" => "240W"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 3,
                'img_id' => '6221fc5001',
            ],
            [
                'name' => 'Generic SMPS Power supply 12V/10A',
                'price' => 1231,
                'discounted_price' => 1111,
                'stock' => 4,
                'specifications' => json_encode([
                    ["specName" => "Voltage", "specValue" => "12V"],
                    ["specName" => "Wattage", "specValue" => "120W"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 3,
                'img_id' => '43e2f845f1',
            ],
            [
                'name' => 'Generic SMPS Power supply 12V/6A',
                'price' => 2222,
                'discounted_price' => 1111,
                'stock' => 4,
                'specifications' => json_encode([
                    ["specName" => "Voltage", "specValue" => "12V"],
                    ["specName" => "Wattage", "specValue" => "72W"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 3,
                'img_id' => 'cc231622d2',
            ],
            [
                'name' => '8 Channel DVR 2MP',
                'price' => 2222,
                'discounted_price' => 1111,
                'stock' => 5,
                'specifications' => json_encode([
                    ["specName" => "Channels", "specValue" => "8 Channels"],
                    ["specName" => "Resolution", "specValue" => "2MP"],
                    
                    ["specName" => "Type", "specValue" => "DVR"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 1,
                'img_id' => 'b6c6a1660c',
            ],
            [
                'name' => '4 Channel DVR 4MP',
                'price' => 535,
                'discounted_price' => 232,
                'stock' => 5,
                'specifications' => json_encode([
                    ["specName" => "Channels", "specValue" => "4 Channels"],
                    ["specName" => "Resolution", "specValue" => "4MP"],
                    ["specName" => "Type", "specValue" => "DVR"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 1,
                'img_id' => '8700fc98f8',
            ],
            [
                'name' => '8 Channel NVR',
                'price' => 1232,
                'discounted_price' => 1111,
                'stock' => 3,
                'specifications' => json_encode([
                    ["specName" => "Channels", "specValue" => "8 Channels"],
                    ["specName" => "Resolution", "specValue" => "6MP"],
                    ["specName" => "Type", "specValue" => "NVR"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 1,
                'img_id' => '96cbead589',
            ],
            [
                'name' => 'Analog Camera 3MP 12V 1A',
                'price' => 600,
                'discounted_price' => 400,
                'stock' => 5,
                'specifications' => json_encode([
                    ["specName" => "Voltage", "specValue" => "12V"],
                    ["specName" => "Wattage", "specValue" => "12W"],
                    ["specName" => "Resolution", "specValue" => "3MP"],
                    ["specName" => "Type", "specValue" => "Analog"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 2,
                'img_id' => '8915a7b6a4',
            ],
            [
                'name' => 'Analog Camera 1MP 12V 0.5A',
                'price' => 700,
                'discounted_price' => 400,
                'stock' => 6,
                'specifications' => json_encode([
                    ["specName" => "Voltage", "specValue" => "12V"],
                    ["specName" => "Wattage", "specValue" => "6W"],
                    ["specName" => "Resolution", "specValue" => "1MP"],
                    ["specName" => "Type", "specValue" => "Analog"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 2,
                'img_id' => '5d7edfe1a1',
            ],
            [
                'name' => 'IP Camera 5MP 24V 2A',
                'price' => 700,
                'discounted_price' => 500,
                'stock' => 6,
                'specifications' => json_encode([
                    ["specName" => "Voltage", "specValue" => "24V"],
                    ["specName" => "Wattage", "specValue" => "48W"],
                    ["specName" => "Resolution", "specValue" => "5MP"],
                    ["specName" => "Type", "specValue" => "IP"]

                ]),
                'category_id' => 1,
                'subcategory_id' => 2,
                'img_id' => '32a9a0e067',
            ],
            [
                'name' => 'IP Camera 4MP 12V 1A',
                'price' => 500,
                'discounted_price' => 400,
                'stock' => 3,
                'specifications' => json_encode([
                    ["specName" => "Voltage", "specValue" => "12V"],
                    ["specName" => "Wattage", "specValue" => "12W"],
                    ["specName" => "Resolution", "specValue" => "4MP"],
                    ["specName" => "Type", "specValue" => "IP"]

                ]),
                'category_id' => 1,
                'subcategory_id' => 2,
                'img_id' => '434f818743',
            ],
            [
                'name' => 'Coaxial Cable 4M',
                'price' => 200,
                'discounted_price' => null,
                'stock' => 5,
                'specifications' => json_encode([
                    ["specName" => "Length", "specValue" => "4M"],
                    ["specName" => "Type", "specValue" => "Coaxial"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 4,
                'img_id' => 'd8e6f8a2f0',
            ],
            [
                'name' => 'Ethernet Cable 4M',
                'price' => 300,
                'discounted_price' => 200,
                'stock' => 5,
                'specifications' => json_encode([
                    ["specName" => "Length", "specValue" => "4M"],
                    ["specName" => "Type", "specValue" => "Ethernet"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 4,
                'img_id' => '81cd1aac82',
            ],
            [
                'name' => 'Ethernet Cable 8M',
                'price' => 400,
                'discounted_price' => 300,
                'stock' => 65,
                'specifications' => json_encode([
                    ["specName" => "Length", "specValue" => "8M"],
                    ["specName" => "Type", "specValue" => "Ethernet"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 4,
                'img_id' => '44e47b0740',
            ],
            [
                'name' => 'Coaxial Cable 8M',
                'price' => 400,
                'discounted_price' => 300,
                'stock' => 4,
                'specifications' => json_encode([
                    ["specName" => "Length", "specValue" => "8M"],
                    ["specName" => "Type", "specValue" => "Coaxial"]
                ]),
                'category_id' => 1,
                'subcategory_id' => 4,
                'img_id' => '0f12816e1c',
            ],
        ]);
    }
}
