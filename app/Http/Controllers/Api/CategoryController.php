<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return  $this->categoryService->getAllCategories();
    }


    public function getImagesByCategoryId($id)
    {
        return $this->categoryService->getImagesByCategoryId($id);
    }
}
