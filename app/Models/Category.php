<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['slug', 'title', 'image'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
