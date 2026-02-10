<?php

namespace App\Models\Task\Traits;

use App\Models\User\User;

trait TaskRelationships
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
