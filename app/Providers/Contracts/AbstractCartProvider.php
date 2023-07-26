<?php
declare(strict_types=1);

namespace App\Providers\Contracts;

use App\Objects\Cart;

abstract class AbstractCartProvider
{
	abstract function getCart(): Cart;
}