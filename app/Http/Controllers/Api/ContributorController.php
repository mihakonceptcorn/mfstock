<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ImageService;

class ContributorController extends Controller
{
    /**
     * @var ImageService
     */
    private $imageService;

    /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getImagesByContributorId($id)
    {
        $user = User::find($id);
        $images = $this->imageService->getImagesByContributorId($id);

        return array_merge($user->toArray(), $images->toArray());
    }
}
