<?php declare(strict_types=1);

namespace App;

use Doctrine\Common\Collections\Collection;

final class CollectionSerializer
{
    public function toArray(Collection $collection): array
    {
        return array_map(function(Arrayable $element) {
            return $element->toArray();
        }, $collection->toArray());
    }
}