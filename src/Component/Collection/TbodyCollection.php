<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Collection;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Tbody;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CollectionTrait;
use Ucscode\UssElement\Contracts\CollectionInterface;

class TbodyCollection implements CollectionInterface
{
    use CollectionTrait;

    public function add(Tbody  $tbody): static
    {
        $this->items[] = $tbody;

        return $this;
    }

    public function get(int $index): ?Tbody 
    {
        return $this->items[$index] ?? null;
    }

    public function has(Tbody  $tbody): bool
    {
        return in_array($tbody, $this->items, true);
    }

    public function remove(Tbody |int $indexOrTbody): static
    {
        if ($indexOrTbody instanceof Tbody) {
            $indexOrTbody = $this->indexOf($indexOrTbody);
        }

        if ($indexOrTbody !== false) {
            /** @var int $indexOrTr */
            if (array_key_exists($indexOrTbody, $this->items)) {
                unset($this->items[$indexOrTbody]);
                
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    public function indexOf(Tbody  $tbody): int|bool
    {
        return array_search($tbody, $this->items, true);
    }
}