<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;

/**
 * @property Tr[] $items
 * @method Tr[] toArray()
 */
class TrCollection extends AbstractCollection
{
    public function add(Tr $tr): static
    {
        if (!$this->has($tr)) {
            $this->items[] = $tr;
        }

        return $this;
    }

    public function get(int $index): ?Tr
    {
        return $this->items[$index] ?? null;
    }

    public function has(Tr $tr): bool
    {
        return in_array($tr, $this->items, true);
    }

    public function remove(Tr|int $trIdentity): static
    {
        if ($trIdentity instanceof Tr) {
            $trIdentity = $this->indexOf($trIdentity);
        }

        if ($trIdentity !== false) {
            /** @var int $indexOrTr */
            if (array_key_exists($trIdentity, $this->items)) {
                unset($this->items[$trIdentity]);
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    public function indexOf(Tr $tr): int|bool
    {
        return array_search($tr, $this->items, true);
    }

    protected function getCollectionType(): string
    {
        return Tr::class;
    }
}
