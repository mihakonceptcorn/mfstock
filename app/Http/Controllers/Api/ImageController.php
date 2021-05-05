<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ImageService;

class ImageController extends Controller
{
    /**
     * @var ImageService
     */
    private $imageService;

    /**
     * @var ImageService
     */
    private $categoryService;

    public function __construct(ImageService $imageService, CategoryService $categoryService)
    {
        $this->imageService = $imageService;
        $this->categoryService = $categoryService;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getImageById(int $id) {
        return $this->imageService->getImageById($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function getImagesByCategoryId($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $images = $this->imageService->getImagesByCategoryId($id);

        return array_merge($category->toArray(), $images->toArray());
    }
}
