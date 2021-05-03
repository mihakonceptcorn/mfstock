<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Services\CategoryService;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    /**
     * @var ImageService
     */
    private $imageService;

    /**
     * @var CategoryService
     */
    private $categoryService;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $images = Image::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return view('admin_panel.image.index', compact('images'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function moderation()
    {
        $images = $this->imageService->getModerationImages();

        return view('admin_panel.image.index', compact('images'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved()
    {
        $images = $this->imageService->getApprovedImages();

        return view('admin_panel.image.index', compact('images'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function declined()
    {
        $images = $this->imageService->getDeclinedImages();

        return view('admin_panel.image.index', compact('images'));
    }

    public function completed()
    {
        $images = $this->imageService->getBoughtImages();

        return view('admin_panel.image.index', compact('images'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();

        return view('admin_panel.image.create', compact('categories'));
    }

    /**
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Image $image)
    {
        $this->imageService->approveImage($image);

        return redirect()->back();
    }

    /**
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function decline(Image $image)
    {
        $this->imageService->declineImage($image);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        $this->imageService->createImage($request);

        return redirect()->back()->withSuccess('Image successfully created');
    }
}
