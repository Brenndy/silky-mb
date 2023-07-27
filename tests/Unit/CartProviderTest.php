<?php

namespace Tests\Unit;

use App\Builders\CartBuilder;
use App\Objects\Product;
use App\Providers\CartProvider;
use Tests\TestCase;

class CartProviderTest extends TestCase
{
    public function testIsCartFromSessionCorrect(): void
    {
        $exceptedProductsCollection = collect();
        $exceptedProductsCollection->add(new Product('Koszulka z bufiastymi rękawami', 100, 1));
        $exceptedProductsCollection->add(new Product('Gumka do włosów', 10, 2));

        $_SESSION['cart'] = '{"cart":{"amount":120,"currency":"PLN","items":[{"name":"Koszulka z bufiastymi rękawami","price":100,"quantity":1},{"name":"Gumka do włosów","price":10,"quantity":2}]}}';

        $cartProvider = new CartProvider(new CartBuilder());
        $cart = $cartProvider->getCart();

        $this->assertEqualsCanonicalizing($cart->getProducts()->toArray(), $exceptedProductsCollection->toArray());
        $this->assertEquals(120, $cart->getSummary());
        $this->assertEquals('PLN', $cart->getCurrency());
    }
}