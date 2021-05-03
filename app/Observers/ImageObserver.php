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
    public function creating(Image $image): void
    {
        $this->setSlug($image);
    }

    /**
     * @param Image $image
     * @return void
     */
    private function setSlug(Image $image): void
    {
        if (empty($image->slug)) {
            $image->slug = Str::slug($image->title . '-' . uniqid());
        }
    }
}
