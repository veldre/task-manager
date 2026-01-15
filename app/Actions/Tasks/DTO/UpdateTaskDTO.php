<?php

namespace App\Actions\Tasks\DTO;

class UpdateTaskDTO
{
    public function __construct(private array $attributes)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return $this->attributes;
    }
}
