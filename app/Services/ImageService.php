<?php

namespace App\Services;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Models\User;
use App\Repositories\ImageRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ImageService
{
    /**
     * @var ImageRepository
     */
    private $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * @return Collection
     */
    public function getApprovedImages()
    {
        $user = Auth::user();

        return $this->imageRepository->getApprovedImagesByUser($user);
    }

    /**
     * @return Collection
     */
    public function getDeclinedImages()
    {
        $user = Auth::user();

        return $this->imageRepository->getDeclinedImagesByUser($user);
    }

    /**
     * @return Collection
     */
    public function getModerationImages()
    {
        $user = Auth::user();

        return $this->imageRepository->getModerationImagesByUser($user);
    }

    /**
     * @return Collection
     */
    public function getBoughtImages()
    {
        $customer = Auth::user();

        return $this->imageRepository->getBoughtImages($customer);
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getImagesByContributorId(int $id)
    {
        return User::with(['images' => function ($query) {
            return $query->where('status', '=', 'approved');
        }])->find($id);
    }

    public function getImagesByCategoryId($id)
    {
        return Image::where('category_id', $id)->where('status', 'approved')->orderByDesc('created_at')->paginate(9);
    }

    /**
     * @param ImageRequest $request
     */
    public function createImage(ImageRequest $request)
    {
        $user = Auth::user();

        $this->imageRepository->createImage($user, $request);
    }

    /**
     * @param Image $image
     */
    public function approveImage(Image $image)
    {
        $image->status = 'approved';
        $image->save();
    }

    /**
     * @param Image $image
     */
    public function declineImage(Image $image)
    {
        $image->status = 'declined';
        $image->save();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getImageById(int $id)
    {
        return Image::with('user')->find($id);
    }
}
