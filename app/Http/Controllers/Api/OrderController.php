<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function buyImage(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->userId,
            'image_id' => $request->imageId,
            'status' => Order::ORDER_COMPLETED,
        ]);

        $order->save();

        return response('', 204);;
    }
}
