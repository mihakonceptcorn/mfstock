<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * @param User $user
     * @return void
     */
    public function creating(User $user)
    {
        $this->setSlug($user);
    }

    /**
     * @param User $user
     * @return void
     */
    private function setSlug(User $user)
    {
        if (empty($user->slug)) {
            $user->slug = Str::slug($user->name);
        }
    }
}
