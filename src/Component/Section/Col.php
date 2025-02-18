<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableElementInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableElementTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Col implements TableElementInterface
{
    use TableElementTrait;

    public function __construct()
    {
        $this->buildElement();
    }

    protected function buildElement(array|Attributes $attributes = []): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_COL, $attributes);
    }
}
