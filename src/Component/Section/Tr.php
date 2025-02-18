<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\CellCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableElementTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Tr implements TableComponentInterface
{
    use TableElementTrait;

    protected CellCollection $cellCollection;

    public function __construct()
    {
        $this->cellCollection = new CellCollection();

        $this->buildElement();
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

    protected function buildElement(array|Attributes $attributes = []): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_TR, $attributes);
    }
}
