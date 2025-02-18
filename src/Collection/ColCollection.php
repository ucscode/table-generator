<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Collection;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Col;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CollectionTrait;
use Ucscode\UssElement\Contracts\CollectionInterface;

class ColCollection implements CollectionInterface
{
    use CollectionTrait;

    public function add(Col $col): static
    {
        $this->items[] = $col;

        return $this;
    }

    public function get(int $index): ?Col
    {
        return $this->items[$index] ?? null;
    }

    public function has(Col $col): bool
    {
        return in_array($col, $this->items, true);
    }

    public function remove(Col|int $indexOrCol): static
    {
        if ($indexOrCol instanceof Col) {
            $indexOrCol = $this->indexOf($indexOrCol);
        }

        if ($indexOrCol !== false) {
            /** @var int $indexOrTr */
            if (array_key_exists($indexOrCol, $this->items)) {
                unset($this->items[$indexOrCol]);
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    public function indexOf(Col $col): int|bool
    {
        return array_search($col, $this->items, true);
    }
}
