<?php

namespace Ucscode\HtmlComponent\TableGenerator\Component\Section;

use Ucscode\HtmlComponent\TableGenerator\Collection\CellCollection;
use Ucscode\HtmlComponent\TableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\TableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\TableGenerator\Traits\RenderableTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\TableComponentTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Tr implements TableComponentInterface
{
    use TableComponentTrait;
    use RenderableTrait;

    protected CellCollection $cellCollection;

    public function __construct(array|Attributes $attributes = [])
    {
        $this->cellCollection = new CellCollection();
        $this->attributes = $attributes instanceof Attributes ? $attributes : new Attributes($attributes);
    }

    public function getCellCollection(): CellCollection
    {
        return $this->cellCollection;
    }

    public function addCell(CellInterface $cell): static
    {
        $this->cellCollection->add($cell);

        return $this;
    }

    public function getCell(int $index): ?CellInterface
    {
        return $this->cellCollection->get($index);
    }

    public function hasCell(CellInterface $cell): bool
    {
        return $this->cellCollection->has($cell);
    }

    public function removeCell(CellInterface|int $cellIdentity): static
    {
        $this->cellCollection->remove($cellIdentity);

        return $this;
    }

    public function indexOf(CellInterface $cell): int|bool
    {
        return $this->cellCollection->indexOf($cell);
    }

    public function createElement(): ElementInterface
    {
        $tr = new ElementNode(NodeNameEnum::NODE_TR, $this->attributes);

        foreach ($this->cellCollection->toArray() as $cell) {
            $tr->appendChild($cell->createElement());
        }

        return $tr;
    }
}
