<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Tbody;

/**
 * @property Tbody[] $items
 * @method Tbody[] toArray()
 */
class TbodyCollection extends AbstractCollection
{
    public function add(Tbody $tbody): static
    {
        $this->items[] = $tbody;

        return $this;
    }

    public function get(int $index): ?Tbody
    {
        return $this->items[$index] ?? null;
    }

    public function has(Tbody $tbody): bool
    {
        return in_array($tbody, $this->items, true);
    }

    public function remove(Tbody|int $tbodyIdentity): static
    {
        if ($tbodyIdentity instanceof Tbody) {
            $tbodyIdentity = $this->indexOf($tbodyIdentity);
        }

        if ($tbodyIdentity !== false) {
            /** @var int $indexOrTr */
            if (array_key_exists($tbodyIdentity, $this->items)) {
                unset($this->items[$tbodyIdentity]);
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    public function indexOf(Tbody $tbody): int|bool
    {
        return array_search($tbody, $this->items, true);
    }

    protected function getCollectionType(): string
    {
        return Tbody::class;
    }
}
