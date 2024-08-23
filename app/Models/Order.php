<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'address',
        'phone_number',
        'status',
        'products'
    ];
    static public function getOrderProducts($orders)
    {
        $productIds = [];
        foreach ($orders as $order) {
            // Check if 'products' key exists and is an array
            // Loop through each product and extract the 'id'
            foreach (json_decode($order['products']) as $product) {
                if (isset($product->id)) {
                    $productIds[] = $product->id;
                }
            }
        }
        $productIds = array_unique($productIds);
        error_log(json_encode($productIds));
        $products = Product::whereIn('id', $productIds)->get();
        return $products;
    }
}
