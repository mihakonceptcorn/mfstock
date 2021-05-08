<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    /**
     * @param $userId
     * @param $imageId
     * @param $status
     */
    public function createOrder($userId, $imageId, $status)
    {
        $order = Order::create([
            'user_id' => $userId,
            'image_id' => $imageId,
            'status' => $status,
        ]);

        $order->save();
    }
}
