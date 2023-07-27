<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Builders\CartBuilder;
use App\Objects\Product;

class CartBuilderTest extends TestCase
{
    public function testIsCartBuilderCorrect(): void
    {
        $exceptedProductsCollection = collect();
        $exceptedProductsCollection->add(new Product('Koszulka z bufiastymi rękawami', 100, 1));
        $exceptedProductsCollection->add(new Product('Gumka do włosów', 10, 2));

        $cartCollection = collect(
            json_decode('{"cart":{"amount":120,"currency":"PLN","items":[{"name":"Koszulka z bufiastymi rękawami","price":100,"quantity":1},{"name":"Gumka do włosów","price":10,"quantity":2}]}}', true)['cart']
        );
        $cartBuilder = new CartBuilder();
        $cart = $cartBuilder->build($cartCollection);

        $this->assertEqualsCanonicalizing($cart->getProducts()->toArray(), $exceptedProductsCollection->toArray());
        $this->assertEquals(120, $cart->getSummary());
        $this->assertEquals('PLN', $cart->getCurrency());   
    }
}