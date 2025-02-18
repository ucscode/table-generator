<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\CellCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableElementInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableElementTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Tr implements TableElementInterface
{
    use TableElementTrait;

    protected CellCollection $cellCollection;

    public function __construct()
    {
        $this->cellCollection = new CellCollection();
        $this->buildElement();
    }

    protected function buildElement(array|Attributes $attributes = []): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_TR, $attributes);
    }
}
