<?php

declare(strict_types=1);

namespace App\Objects;

use Illuminate\Support\Collection;

class Cart
{
    private Collection $cartProducts;
    private float $summary = 0;
    private ?string $currency = null;

    public function __construct()
    {
        $this->cartProducts = collect();
    }

    public function setSummary(float $summary): void
    {
        $this->summary = $summary;
    }

    public function getSummary(): float
    {
        return $this->summary;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function addProduct(Product $product): void
    {
        $this->cartProducts->add($product);
    }

    public function getProducts(): Collection
    {
        return $this->cartProducts;
    }
}