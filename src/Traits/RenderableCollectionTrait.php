<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Traits;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\RenderableInterface;
use Ucscode\UssElement\Collection\ElementList;

/**
 * @property RenderableInterface[] $items
 */
trait RenderableCollectionTrait
{
    public function render(?int $indent = null): string
    {
        return implode(array_map(
            fn (RenderableInterface $item) => $item->getElement()->render(),
            $this->items
        ));
    }

    public function getElementList(): ElementList
    {
        return new ElementList(array_map(
            fn (RenderableInterface $item) => $item->getElement(),
            $this->items
        ));
    }
}
