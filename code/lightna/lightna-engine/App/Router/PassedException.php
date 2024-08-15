<?php

declare(strict_types=1);

namespace Lightna\Engine\App\Router;

use Exception;
use Lightna\Engine\App\ObjectManagerIgnore;

class PassedException extends Exception implements ObjectManagerIgnore
{
}
