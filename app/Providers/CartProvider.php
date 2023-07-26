<?php
declare(strict_types=1);

namespace App\Providers;

use App\Objects\Cart;
use App\Objects\Product;
use App\Providers\Contracts\AbstractCartProvider;
use Illuminate\Support\Collection;
use \Exception;
use Str;

class CartProvider extends AbstractCartProvider
{
    private Collection $sessionCart;
    private Cart $cart;

    public function getCart(): Cart
    {
        $this->cart = new Cart();

        $this->fetchCartFromSession();
        $this->addProductsToCart();
        $this->cart->setCurrency($this->sessionCart->get('currency'));
        $this->cart->setSummary($this->sessionCart->get('amount'));

        return $this->cart;
    }

    private function addProductsToCart(): void
    {
        collect($this->sessionCart->get('items'))->each(function($item): void {
            $product = new Product($item['name'], $item['price'], $item['quantity']);
            $this->cart->addProduct($product);
        });
    }

    private function fetchCartFromSession(): void
    {
        $this->validateCart();
        $this->sessionCart = collect(json_decode($_SESSION['cart'], true)['cart']);
    }

    /** @throws Exception */
    private function validateCart(): void
    {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            throw new Exception('Shopcart is not existing in session');
        }

        if (!Str::isJson($_SESSION['cart'])) {
            throw new Exception('Shopcart JSON is wrong or corrupted');
        }
    }
}