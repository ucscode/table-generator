<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\ColCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Col;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableComponentTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class ColGroup implements TableComponentInterface
{
    use TableComponentTrait;
    use RenderableTrait;

    protected ColCollection $colCollection;

    public function __construct()
    {
        $this->colCollection = new ColCollection();
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
        return new ElementNode(NodeNameEnum::NODE_COLGROUP, $this->attributes);
    }
}
