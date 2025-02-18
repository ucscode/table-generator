<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction\AbstractCell;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Td extends AbstractCell
{
    protected function buildElement(array|Attributes $attributes = []): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_TD, $attributes);
    }
}
