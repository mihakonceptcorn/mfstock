<?php

namespace App\Services;

use App\Jobs\SendOrderEmailJob;
use App\Models\Image;
use App\Models\Order;
use App\Models\User;
use App\Repositories\OrderRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

class OrderService
{
    use DispatchesJobs;

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
        $userId = $request->userId;
        $imageId = $request->imageId;
        $status = Order::ORDER_COMPLETED;
        $this->orderRepository->createOrder($userId, $imageId, $status);

        $image = Image::find($imageId);
        $contributor = User::find($image->user_id);
        $customer = User::find($userId);

        $customerDetails = [
            'email' => $customer->email,
            'subject' => 'You bought a photo',
            'text' => 'You bought a photo',
        ];

        $contributorDetails = [
            'email' => $contributor->email,
            'subject' => 'Your photo has been sold',
            'text' => 'Your photo has been sold',
        ];

        $mailCustomerJob = new SendOrderEmailJob($customerDetails);
        $mailContributorJob = new SendOrderEmailJob($contributorDetails);

        $this->dispatchNow($mailCustomerJob);
        $this->dispatchNow($mailContributorJob);
    }
}
