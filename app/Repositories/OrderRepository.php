<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    /**
     * @param int $userId
     * @param int $imageId
     * @param string $status
     */
    public function createOrder(int $userId, int $imageId, string $status)
    {
        $order = Order::create([
            'user_id' => $userId,
            'image_id' => $imageId,
            'status' => $status,
        ]);

        $order->save();
    }
}
