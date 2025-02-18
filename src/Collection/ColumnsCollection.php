<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Collection;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CollectionInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Grid\Columns;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CollectionTrait;

/**
 * @property Columns[] $items
 */
class ColumnsCollection implements CollectionInterface
{
    use CollectionTrait;

    public function add(Columns $columns): static
    {
        $this->items[] = $columns;

        return $this;
    }

    public function get(int $index): ?Columns
    {
        return $this->items[$index] ?? null;
    }

    public function has(Columns $columns): bool
    {
        return in_array($columns, $this->items, true);
    }

    public function remove(Columns|int $columnsIdentity): static
    {
        if ($columnsIdentity instanceof Columns) {
            $columnsIdentity = $this->indexOf($columnsIdentity);
        }

        if ($columnsIdentity !== false) {
            /** @var int $indexOrTr */
            if (array_key_exists($columnsIdentity, $this->items)) {
                unset($this->items[$columnsIdentity]);
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    public function indexOf(Columns $columns): int|bool
    {
        return array_search($columns, $this->items, true);
    }
}
