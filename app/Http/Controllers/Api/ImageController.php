<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getImagesByCategoryId($id)
    {
        return Image::where('category_id', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function getImagesByContributorId($id)
    {
        return Image::with('user')
            ->where('user_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
        //return Image::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function getImageById($id) {
        return Image::with('user')->find($id);
    }
}
