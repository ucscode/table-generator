<?php

namespace Ucscode\HtmlComponent\TableGenerator\Component;

use Ucscode\HtmlComponent\TableGenerator\Collection\ColCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Col;
use Ucscode\HtmlComponent\TableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\TableGenerator\Traits\RenderableTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\TableComponentTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class ColGroup implements TableComponentInterface
{
    use TableComponentTrait;
    use RenderableTrait;

    protected ColCollection $colCollection;

    public function __construct(array|Attributes $attributes = [])
    {
        $this->colCollection = new ColCollection();
        $this->attributes = $attributes instanceof Attributes ? $attributes : new Attributes($attributes);
    }

    public function getColCollection(): ColCollection
    {
        return $this->colCollection;
    }

    public function addCol(Col $col): static
    {
        $this->colCollection->add($col);

        return $this;
    }

    public function getCol(int $index): ?Col
    {
        return $this->colCollection->get($index);
    }

    public function hasCol(Col $col): bool
    {
        return $this->colCollection->has($col);
    }

    public function removeCol(Col|int $colIdentity): static
    {
        $this->colCollection->remove($colIdentity);

        return $this;
    }

    public function indexOf(Col $col): int|bool
    {
        return $this->colCollection->indexOf($col);
    }

    public function createElement(): ElementInterface
    {
        $colGroup = new ElementNode(NodeNameEnum::NODE_COLGROUP, $this->attributes);

        foreach ($this->colCollection->toArray() as $col) {
            $colGroup->appendChild($col->createElement());
        }

        return $colGroup;
    }
}
