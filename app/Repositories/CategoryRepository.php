<?php


namespace App\Repositories;


use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository
{
    /**
     * @var Category
     */
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Collection
     */
    public function getAllCategories()
    {
       return $this->category::orderBy('title')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCategoryById($id)
    {
        return $this->category::find($id);
    }

    /**
     * @param CategoryRequest $request
     */
    public function createCategory(CategoryRequest $request)
    {
        $directory = 'public/categories';

        $request->file('image')->store($directory);

        $category = new Category();
        $category->title = $request->title;
        $category->image = 'categories/' . $request->file('image')->hashName();

        $category->save();
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     */
    public function updateCategory(CategoryRequest $request, Category $category)
    {
        $category->title = $request->title;
        $category->save();
    }
}
