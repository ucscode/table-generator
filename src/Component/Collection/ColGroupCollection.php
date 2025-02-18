<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Collection;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\ColGroup;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CollectionTrait;
use Ucscode\UssElement\Contracts\CollectionInterface;

class ColGroupCollection implements CollectionInterface
{
    use CollectionTrait;

    public function add(ColGroup $colGroup): static
    {
        $this->items[] = $colGroup;

        return $this;
    }

    public function get(int $index): ?ColGroup
    {
        return $this->items[$index] ?? null;
    }

    public function has(ColGroup $colGroup): bool
    {
        return in_array($colGroup, $this->items, true);
    }

    public function remove(ColGroup|int $indexOrColGroup): static
    {
        if ($indexOrColGroup instanceof ColGroup) {
            $indexOrColGroup = $this->indexOf($indexOrColGroup);
        }

        if ($indexOrColGroup !== false) {
            /** @var int $indexOrTr */
            if (array_key_exists($indexOrColGroup, $this->items)) {
                unset($this->items[$indexOrColGroup]);
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    public function indexOf(ColGroup $colGroup): int|bool
    {
        return array_search($colGroup, $this->items, true);
    }
}
