<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Collection;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Col;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CollectionInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CollectionTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableCollectionTrait;

/**
 * @property Col[] $items
 * @method Col[] toArray()
 */
class ColCollection implements CollectionInterface
{
    use CollectionTrait;
    use RenderableCollectionTrait;

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
}
