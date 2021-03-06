<?php

namespace App\Services;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Models\User;
use App\Repositories\ImageRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ImageService
{
    /**
     * @var ImageRepository
     */
    private ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getApprovedImages(): LengthAwarePaginator
    {
        $user = Auth::user();

        return $this->imageRepository->getApprovedImagesByUser($user);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getDeclinedImages(): LengthAwarePaginator
    {
        $user = Auth::user();

        return $this->imageRepository->getDeclinedImagesByUser($user);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getModerationImages(): LengthAwarePaginator
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $images = $this->imageRepository->getModerationAdminImages();
        } else {
            $images = $this->imageRepository->getModerationContributorImages($user);
        }

        return $images;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getBoughtImages(): LengthAwarePaginator
    {
        $customer = Auth::user();

        return $this->imageRepository->getBoughtImages($customer);
    }

    /**
     * @param int $id
     * @return LengthAwarePaginator
     */
    public function getImagesByContributorId(int $id): LengthAwarePaginator
    {
        $user = User::find($id);

        return $this->imageRepository->getApprovedImagesByUser($user);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getImagesByCategoryId(int $id)
    {
        return $this->imageRepository->getImagesByCategoryId($id);
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

    /**
     * @param $keyword
     * @return Collection
     */
    public function search($keyword): Collection
    {
        return $this->imageRepository->search($keyword);
    }
}
