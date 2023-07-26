<?php
declare(strict_types=1);

namespace App\Providers;

use App\Builders\CartBuilder;
use App\Objects\Cart;
use App\Objects\Product;
use App\Providers\Contracts\AbstractCartProvider;
use App\Validators\CartSessionValidator;
use Illuminate\Support\Collection;
use \Exception;
use Str;

class CartProvider extends AbstractCartProvider
{
    private CartBuilder $cartBuilder;
 
    public function __construct()
    {
        $this->cartBuilder = new CartBuilder();
    }

    public function getCart(): Cart
    {
        return $this->cartBuilder->build($this->fetchCartFromSession());
    }

    private function fetchCartFromSession(): Collection
    {
        $sessionCart = json_decode($_SESSION['cart'], true);
        CartSessionValidator::validate($sessionCart);

        return collect($sessionCart['cart']);
    }
}