<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Services\CategoryService;
use App\Services\ImageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    /**
     * @var ImageService
     */
    private ImageService $imageService;

    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * @param ImageService $imageService
     * @param CategoryService $categoryService
     */
    public function __construct(ImageService $imageService, CategoryService $categoryService)
    {
        $this->imageService = $imageService;
        $this->categoryService = $categoryService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $user = Auth::user();

        $images = Image::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return view('admin_panel.image.index', compact('images'));
    }

    /**
     * @return View
     */
    public function moderation(): View
    {
        $images = $this->imageService->getModerationImages();

        return view('admin_panel.image.index', compact('images'));
    }

    /**
     * @return View
     */
    public function approved(): View
    {
        $images = $this->imageService->getApprovedImages();

        return view('admin_panel.image.index', compact('images'));
    }

    /**
     * @return View
     */
    public function declined(): View
    {
        $images = $this->imageService->getDeclinedImages();

        return view('admin_panel.image.index', compact('images'));
    }

    /**
     * @return View
     */
    public function completed(): View
    {
        $images = $this->imageService->getBoughtImages();

        return view('admin_panel.image.index', compact('images'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $categories = $this->categoryService->getAllCategories();

        return view('admin_panel.image.create', compact('categories'));
    }

    /**
     * @param Image $image
     * @return RedirectResponse
     */
    public function approve(Image $image): RedirectResponse
    {
        $this->imageService->approveImage($image);

        return redirect()->back();
    }

    /**
     * @param Image $image
     * @return RedirectResponse
     */
    public function decline(Image $image): RedirectResponse
    {
        $this->imageService->declineImage($image);

        return redirect()->back();
    }

    /**
     * @param  ImageRequest  $request
     * @return RedirectResponse
     */
    public function store(ImageRequest $request): RedirectResponse
    {
        $this->imageService->createImage($request);

        return redirect()->back()->withSuccess('Image successfully created');
    }
}
