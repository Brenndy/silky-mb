<?php

declare(strict_types=1);

namespace App\Builders;
use App\Objects\Cart;
use App\Objects\Product;
use Illuminate\Support\Collection;

class CartBuilder
{
    public function build(Collection $cart): Cart
    {
        return new Cart($cart->get('amount'), $cart->get('currency'), $this->buildProducts(collect($cart->get('items'))));
    }

    private function buildProducts(Collection $items): Collection
    {
        $productsCollection = collect();

        $items->each(
            function ($item) use ($productsCollection): void {
                $productsCollection->add(new Product($item['name'], $item['price'], $item['quantity']));
            }
        );

        return $productsCollection;
    }
}