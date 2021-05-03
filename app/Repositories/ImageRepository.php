<?php


namespace App\Repositories;


use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ImageRepository
{
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function getApprovedImagesByUser(User $user)
    {
        if ($user->hasRole('admin')) {
            $images = DB::table('images')
                ->where('status', '=', 'approved')
                ->get();
        } else {
            $images = DB::table('images')
                ->where('user_id', '=', $user->id)
                ->where('status', '=', 'approved')
                ->get();
        }

        return $images;
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function getDeclinedImagesByUser(User $user)
    {
        if ($user->hasRole('admin')) {
            $images = DB::table('images')
                ->where('status', '=', 'declined')
                ->get();
        } else {
            $images = DB::table('images')
                ->where('user_id', '=', $user->id)
                ->where('status', '=', 'declined')
                ->get();
        }

        return $images;
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function getModerationImagesByUser(User $user)
    {
        if ($user->hasRole('admin')) {
            $images = DB::table('images')
                ->where('status', '=', 'moderation')
                ->get();
        } else {
            $images = DB::table('images')
                ->where('user_id', '=', $user->id)
                ->where('status', '=', 'moderation')
                ->get();
        }

        return $images;
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function getBoughtImages(User $user)
    {
        return $user->boughtImages;
    }

    public function createImage(User $user, ImageRequest $request)
    {
        $directory = 'public/' . strtolower($user->name);
        $request->file('image')->store($directory);

        $image = new Image();

        $image->title = $request->title;
        $image->path = strtolower($user->name) . '/' . $request->file('image')->hashName();
        $image->description = $request->description;
        $image->keywords = $request->keywords;
        $image->category_id = $request->category_id;
        $image->user_id = $user->id;
        $image->status = 'moderation';

        $image->save();
    }
}
