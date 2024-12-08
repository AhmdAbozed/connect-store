<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function addOrder(Request $request)
    {
        error_log('user is '.json_encode(Auth::getUser()));
        $order = Order::query()->create([
            'fullname' => $request->input('Name'),
            'address' => $request->input('Address'),
            'phone_number' => $request->input('PhoneNumber'),
            'status' => 'pending',
            'products' => $request->input('Products'),
            'user_id'=>$request->user() ? $request->user()->id : null
        ]);
        return response($order);
    }
    public function deleteOrder(Request $request, $order_id)
    {
        $order = Order::query()->find($order_id);
        error_log('user_id: '.Auth::getUser().' orderuserid: '.$order->user_id);
        
        if(Auth::getUser() && $order->user_id && Auth::getUser()->id == $order->user_id)
        {
            $order->delete();
            
        return 200;
        }else{
            abort(403,'Unauthorized');
        }

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
