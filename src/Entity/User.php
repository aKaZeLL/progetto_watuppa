<?php

namespace App\Entity;

class User
{
    public function __construct(
        public ?int $id = null,
        public ?string $nome = null,
        public ?string $cognome = null,
        public ?string $email = null,
        public ?string $password = null,
        public ?string $created_at = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['nome'] ?? null,
            $data['cognome'] ?? null,
            $data['email'] ?? null,
            $data['password'] ?? null,
            $data['created_at'] ?? null
        );
    }
}