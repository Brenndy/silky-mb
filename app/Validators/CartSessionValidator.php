<?php

declare(strict_types=1);

namespace App\Validators;

use \Exception;
use Validator;

class CartSessionValidator
{
    public static function validate(array $cartSession): void
    {
        $validate = Validator::make($cartSession, self::rules());
        
        if (!$validate->passes()) {
            throw new Exception('Shopcart JSON is wrong or corrupted');
        }
    }

    private static function rules(): array
    {
        return [
            'cart' => 'required|array',
            'cart.amount' => 'required|numeric',
            'cart.currency' => 'required|string',
            'cart.items' => 'required|array',
            'cart.items.*.name' => 'required|string',
            'cart.items.*.price' => 'required|numeric',
            'cart.items.*.quantity' => 'required|integer'
        ];
    }
}