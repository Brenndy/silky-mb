<?php

declare(strict_types=1);

namespace App\Objects;

use Illuminate\Support\Collection;

class Cart
{
    public function __construct(private float $summary, private string $currency, private Collection $cartProducts)
    {
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getSummary(): float
    {
        return $this->summary;
    }

    public function getProducts(): Collection
    {
        return $this->cartProducts;
    }
}