<?php
declare(strict_types=1);

namespace App\Providers\Contracts;

use App\Objects\Cart;
use \Exception;

abstract class AbstractCartProvider
{
	abstract function getCart(): Cart;
}