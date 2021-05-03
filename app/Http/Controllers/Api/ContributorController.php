<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ContributorController extends Controller
{
    public function getImagesByContributorId($id)
    {
        return User::with('images')->find($id);
    }
}
