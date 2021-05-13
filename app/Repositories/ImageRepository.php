<?php


namespace App\Repositories;


use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
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
     * @return LengthAwarePaginator
     */
    public function getApprovedImagesByUser(User $user)
    {
        if ($user->hasRole('admin')) {
            $images = DB::table('images')
                ->where('status', '=', 'approved')
                ->paginate(9);
        } else {
            $images = DB::table('images')
                ->where('user_id', '=', $user->id)
                ->where('status', '=', 'approved')
                ->paginate(9);
        }

        return $images;
    }

    /**
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function getDeclinedImagesByUser(User $user)
    {
        if ($user->hasRole('admin')) {
            $images = DB::table('images')
                ->where('status', '=', 'declined')
                ->paginate(9);
        } else {
            $images = DB::table('images')
                ->where('user_id', '=', $user->id)
                ->where('status', '=', 'declined')
                ->paginate(9);
        }

        return $images;
    }

    /**
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function getModerationAdminImages(User $user)
    {
        $images = DB::table('images')
            ->where('status', '=', 'moderation')
            ->paginate(9);

        return $images;
    }

    /**
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function getModerationContributorImages(User $user)
    {
        $images = DB::table('images')
            ->where('user_id', '=', $user->id)
            ->where('status', '=', 'moderation')
            ->paginate(9);

        return $images;
    }

    public function getImagesByCategoryId($id)
    {
        return Image::where('category_id', $id)->where('status', 'approved')->orderByDesc('created_at')->paginate(9);
    }

    /**
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function getBoughtImages(User $user)
    {
        return $user->boughtImages()->paginate(9);
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

    /**
     * @param $keyword
     * @return Collection
     */
    public function search($keyword)
    {
        return Image::where('keywords', 'LIKE', '%' . $keyword . '%')->paginate(10);
    }
}
