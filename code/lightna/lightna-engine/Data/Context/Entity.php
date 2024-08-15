<?php

declare(strict_types=1);

namespace Lightna\Engine\Data\Context;

use Lightna\Engine\Data\DataA;

class Entity extends DataA
{
    public string $type;
    public string|int|null $id;
}
