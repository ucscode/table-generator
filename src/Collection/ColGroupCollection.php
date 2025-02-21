<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\ColGroup;

/**
 * @property ColGroup[] $items
 * @method ColGroup[] toArray()
 */
class ColGroupCollection extends AbstractCollection
{
    public function add(ColGroup $colGroup): static
    {
        if (!$this->has($colGroup)) {
            $this->items[] = $colGroup;
        }

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

    protected function getCollectionType(): string
    {
        return ColGroup::class;
    }
}
