<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    /**
     * @var ImageService
     */
    private $imageService;

    /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param string $keyword
     * @return Collection
     */
    public function index(string $keyword): Collection
    {
        return $this->imageService->search($keyword);
    }
}
