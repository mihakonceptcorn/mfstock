<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Request $request
     */
    public function buyImage(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->userId,
            'image_id' => $request->imageId,
            'status' => Order::ORDER_COMPLETED,
        ]);

        $order->save();
    }
}
