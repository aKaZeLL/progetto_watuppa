<?php

namespace App\Entity;

class Product {

    public function __construct(
        public ?int $id = null,
        public ?string $nome = null,
        public ?string $descrizione = null,
        public ?float $prezzo = null,
        public ?bool $disponibile = null,
        public ?string $created_at = null
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['nome'] ?? null,
            $data['descrizione'] ?? null,
            $data['prezzo'] ?? null,
            $data['disponibile'] ?? null,
            $data['created_at'] ?? null
        );
    }
}