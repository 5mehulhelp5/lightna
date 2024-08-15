<?php

declare(strict_types=1);

namespace Lightna\Magento\Data\Session;

use Lightna\Engine\Data\DataA;
use Lightna\Magento\Data\Session\Cart\Item;

/**
 * @property Item[] $items
 * @method qty(string $escapeMethod = null)
 * @method grandTotal(string $escapeMethod = null)
 */
class Cart extends DataA
{
    public array $items;
    public int $qty = 0;
    public float $grandTotal;
}