<?php

declare(strict_types=1);

namespace Lightna\Magento\App\Plugin\App;

use Laminas\Db\Sql\Select;
use Lightna\Engine\App\Database;
use Lightna\Engine\App\ObjectA;

class Scope extends ObjectA
{
    protected Database $db;

    public function getList(): array
    {
        return $this->db->fetchCol($this->getSelect());
    }

    protected function getSelect(): Select
    {
        return $this->db
            ->select('store')
            ->columns(['store_id'])
            ->where('store_id > 0');
    }
}