<?php

namespace App\Policies;

use App\Models\Partner;
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

    public function create(User $user) {
        return $user->role == 'partner';
    }

    public function update(User $user, Place $place) {
        if (!$user->partner) {
            return false;
        }

        return $user->partner->id === $place->partner_id;
    }
}
