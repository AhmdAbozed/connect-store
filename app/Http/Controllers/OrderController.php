<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function addOrder(Request $request)
    {
        $order = Order::query()->create([
            'fullname' => $request->input('Name'),
            'address' => $request->input('Address'),
            'phone_number' => $request->input('PhoneNumber'),
            'status' => 'pending',
            'products' => $request->input('Products')
        ]);
        return response($order);
    }
    public function updateOrder(Request $request, $order_id)
    {
        $order = Order::query()->find($order_id);
        if ($request->input('status') == 'complete') {
            $order->update(['status' => 'complete']);
            return 200;
        } else if ($request->input('status') == 'delete') {
            $order->delete();
            return 200;
        }
    }
    public function getOrders(Request $request){
        $orders = Order::all();
        return response($orders);        
    }
}
