<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Collection;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CollectionTrait;
use Ucscode\UssElement\Contracts\CollectionInterface;

class CellCollection implements CollectionInterface
{
    use CollectionTrait;

    public function add(CellInterface $cell): static
    {
        $this->items[] = $cell;

        return $this;
    }

    public function get(int $index): ?CellInterface
    {
        return $this->items[$index] ?? null;
    }

    public function has(CellInterface $cell): bool
    {
        return in_array($cell, $this->items, true);
    }

    public function remove(CellInterface|int $indexOrCell): static
    {
        if ($indexOrCell instanceof CellInterface) {
            $indexOrCell = $this->indexOf($indexOrCell);
        }

        if ($indexOrCell !== false) {
            /** @var int $indexOrCell */
            if (array_key_exists($indexOrCell, $this->items)) {
                unset($this->items[$indexOrCell]);
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    public function indexOf(CellInterface $cell): int|bool
    {
        return array_search($cell, $this->items, true);
    }
}
