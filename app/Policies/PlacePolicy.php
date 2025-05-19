<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\User;

class PlacePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Place $place) {
        if (!$user->partner) {
            return false;
        }

        return $user->partner->id === $place->partner_id;
    }
}
