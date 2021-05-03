<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return  Category::orderBy('title')->get();
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found',
             ])->setStatusCode(404);
        }

        return $category;
    }

    public function getImagesByCategoryId($id)
    {
        return Category::with('images')->find($id);
    }
}
