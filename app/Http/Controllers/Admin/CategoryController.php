<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $categories = $this->categoryService->getAllCategories();

        return view('admin_panel.category.index', compact('categories'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin_panel.category.create');
    }

    /**
     * @param CategoryRequest $request
     * @return mixed
     */
    public function store(CategoryRequest  $request)
    {
        $this->categoryService->createCategory($request);

        return redirect()->back()->withSuccess('Category successfully created');
    }

    /**
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('admin_panel.category.edit', compact('category'));
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return mixed
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($request, $category);

        return redirect()->back()->withSuccess('Category successfully updated');
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->withSuccess('Category successfully deleted');
    }
}
