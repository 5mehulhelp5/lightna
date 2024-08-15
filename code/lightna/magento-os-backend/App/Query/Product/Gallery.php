<?php

declare(strict_types=1);

namespace Lightna\Magento\App\Query\Product;

use Laminas\Db\Sql\Select;
use Lightna\Engine\App\Database;
use Lightna\Engine\App\ObjectA;
use Lightna\Magento\App\Query\Config as MagentoConfig;

class Gallery extends ObjectA
{
    protected Database $db;
    protected MagentoConfig $magentoConfig;
    protected string $cryptKey;

    protected function init(): void
    {
        $this->cryptKey = $this->magentoConfig->get()['crypt']['key'];
    }

    public function getItems(array $entityIds): array
    {
        $items = [];
        foreach ($this->db->fetch($this->getItemsSelect($entityIds)) as $row) {
            $items[$row['entity_id']][] = $row['value'];
        }

        return $items;
    }

    protected function getItemsSelect(array $entityIds): Select
    {
        $select = $this->db->select()
            ->from(['g' => 'catalog_product_entity_media_gallery'])
            ->join(
                ['e' => 'catalog_product_entity_media_gallery_value_to_entity'],
                'e.value_id = g.value_id',
            )
            ->where('g.attribute_id = 90 and g.media_type = "image" and g.disabled = 0');

        $select->where->in('e.entity_id', $entityIds);

        return $select;
    }

    public function getCompressedTypes(string $image): array
    {
        return [
            'tile' => $this->getHash(285, 354) . $image,
            'preview' => $this->getHash(535, 664) . $image,
            'thumbnail' => $this->getHash(100, 124) . $image,
        ];
    }

    protected function getHash(int $w, int $h): string
    {
        return hash_hmac(
            'md5',
            "h:{$h}_w:{$w}_rgb255,255,255_r:empty_q:90_proportional_frame_transparency_doconstrainonly",
            $this->cryptKey,
            false
        );
    }
}
