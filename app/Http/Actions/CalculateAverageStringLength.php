<?php

namespace App\Http\Actions;

use App\Models\InputString;
use App\Models\User;

class CalculateAverageStringLength
{
    public static function run(User $user): int
    {
        return (int) round(InputString::query()
            ->where('user_id', $user->getKey())
            ->avg('length'));
    }
}
