<?php

namespace App\Entity;

class Order {

    public function __construct(
        public ?int $id = null,
        public ?int $user_id = null,
        public ?string $data_ordine = null,
        public ?string $stato = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['user_id'] ?? null,
            $data['data_ordine'] ?? null,
            $data['stato'] ?? null,
        );
    }
}