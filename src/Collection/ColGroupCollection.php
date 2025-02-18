<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Collection;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\ColGroup;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CollectionInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CollectionTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableCollectionTrait;

/**
 * @property ColGroup[] $items
 * @method ColGroup[] toArray()
 */
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

    public function remove(ColGroup|int $colGroupIdentity): static
    {
        if ($colGroupIdentity instanceof ColGroup) {
            $colGroupIdentity = $this->indexOf($colGroupIdentity);
        }

        if ($colGroupIdentity !== false) {
            /** @var int $indexOrTr */
            if (array_key_exists($colGroupIdentity, $this->items)) {
                unset($this->items[$colGroupIdentity]);
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
