<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Str;

class ImageObserver
{
    /**
     * Handle the Image "created" event.
     *
     * @param  Image  $image
     * @return void
     */
    public function creating(Image $image)
    {
        $this->setSlug($image);
    }

    /**
     * @param Image $image
     * @return void
     */
    private function setSlug(Image $image)
    {
        if (empty($image->slug)) {
            $image->slug = Str::slug($image->title . '-' . uniqid());
        }
    }
}
