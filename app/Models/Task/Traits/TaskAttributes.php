<?php

namespace App\Models\Task\Traits;

trait TaskAttributes
{
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = is_string($value) ? trim($value) : $value;
    }
}
