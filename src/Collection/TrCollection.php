<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Collection;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CollectionTrait;
use Ucscode\UssElement\Contracts\CollectionInterface;

class TrCollection implements CollectionInterface
{
    use CollectionTrait;

    /**
     * Table rows
     *
     * @var Tr[]
     */
    protected array $items = [];

    public function add(Tr $tr): static
    {
        $this->items[] = $tr;

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

    public function remove(Tr|int $indexOrTr): static
    {
        if ($indexOrTr instanceof Tr) {
            $indexOrTr = $this->indexOf($indexOrTr);
        }

        if ($indexOrTr !== false) {
            /** @var int $indexOrTr */
            if (array_key_exists($indexOrTr, $this->items)) {
                unset($this->items[$indexOrTr]);
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    public function indexOf(Tr $tr): int|bool
    {
        return array_search($tr, $this->items, true);
    }
}
