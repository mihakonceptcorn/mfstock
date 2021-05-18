<?php

namespace App\Services;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Collection;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

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
    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAllCategories();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCategoryById($id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    /**
     * @param CategoryRequest $request
     */
    public function createCategory(CategoryRequest $request)
    {
        $this->categoryRepository->createCategory($request);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     */
    public function updateCategory(CategoryRequest $request, Category $category)
    {
        $this->categoryRepository->updateCategory($request, $category);
    }
}
