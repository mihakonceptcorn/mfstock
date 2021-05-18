<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ImageController extends Controller
{
    /**
     * @var ImageService
     */
    private ImageService $imageService;

    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * @param ImageService $imageService
     * @param CategoryService $categoryService
     */
    public function __construct(ImageService $imageService, CategoryService $categoryService)
    {
        $this->imageService = $imageService;
        $this->categoryService = $categoryService;
    }

    /**
     * @param int $id
     * @return Collection|Model|null
     */
    public function getImageById(int $id)
    {
        return $this->imageService->getImageById($id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getImagesByCategoryId(int $id): array
    {
        $category = $this->categoryService->getCategoryById($id);
        $images = $this->imageService->getImagesByCategoryId($id);

        return array_merge($category->toArray(), $images->toArray());
    }
}
