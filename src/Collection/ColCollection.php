<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Col;

/**
 * @property Col[] $items
 * @method Col[] toArray()
 */
class ColCollection extends AbstractCollection
{
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

    public function remove(Col|int $colIdentity): static
    {
        if ($colIdentity instanceof Col) {
            $colIdentity = $this->indexOf($colIdentity);
        }

        if ($colIdentity !== false) {
            /** @var int $indexOrTr */
            if (array_key_exists($colIdentity, $this->items)) {
                unset($this->items[$colIdentity]);
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    public function indexOf(Col $col): int|bool
    {
        return array_search($col, $this->items, true);
    }

    protected function getCollectionType(): string
    {
        return Col::class;
    }
}
