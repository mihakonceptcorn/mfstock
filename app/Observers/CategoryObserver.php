<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * @param  Category  $category
     * @return void
     */
    public function creating(Category $category): void
    {
        $this->setSlug($category);
    }

    /**
     * @param Category $category
     * @return void
     */
    private function setSlug(Category $category): void
    {
        if (empty($category->slug)) {
            $category->slug = Str::slug($category->title);
        }
    }
}
