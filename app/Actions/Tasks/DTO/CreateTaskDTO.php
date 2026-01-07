<?php

namespace App\Actions\Tasks\DTO;

class CreateTaskDTO
{
    public function __construct(public string $title, public string $priority, public ?string $dueAt)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            priority: $data['priority'],
            dueAt: $data['due_at'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'priority' => $this->priority,
            'due_at' => $this->dueAt,
        ];
    }
}
