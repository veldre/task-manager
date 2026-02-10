<?php

namespace App\Actions\Tasks\DTO;

class CreateTaskDTO
{
    public function __construct(public int $userId, public string $title, public string $priority, public ?string $dueAt) {}

    public static function fromArray(array $data, int $userId): self
    {
        return new self(
            userId: $userId,
            title: $data['title'],
            priority: $data['priority'],
            dueAt: $data['due_at'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'title' => $this->title,
            'priority' => $this->priority,
            'due_at' => $this->dueAt,
        ];
    }
}
