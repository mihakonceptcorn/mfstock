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
    private ImageService $imageService;

    /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getImagesByContributorId(int $id): array
    {
        $user = User::find($id);
        $images = $this->imageService->getImagesByContributorId($id);

        return array_merge($user->toArray(), $images->toArray());
    }
}
