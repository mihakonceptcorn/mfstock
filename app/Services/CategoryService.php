<?php

namespace App\Services;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ImageRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Collection;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Collection
     */
    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    /**
     * @param CategoryRequest $request
     */
    public function createCategory(CategoryRequest $request)
    {
        $this->categoryRepository->createCategory($request);
    }

    public function updateCategory(CategoryRequest $request, Category $category)
    {
        $this->categoryRepository->updateCategory($request, $category);
    }
}
