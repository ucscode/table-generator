<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\CellCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\RenderableInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Tr implements RenderableInterface
{
    use RenderableTrait;

    protected CellCollection $cellCollection;

    public function __construct()
    {
        $this->cellCollection = new CellCollection();
        $this->buildElement();
    }

    protected function buildElement(): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_TR);
    }
}
