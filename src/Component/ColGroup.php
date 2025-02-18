<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\ColCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Col;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableElementTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class ColGroup implements TableComponentInterface
{
    use TableElementTrait;

    protected ColCollection $colCollection;

    public function __construct()
    {
        $this->colCollection = new ColCollection();
        $this->buildElement();
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

    protected function buildElement(array|Attributes $attributes = []): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_COLGROUP, $attributes);
    }
}
