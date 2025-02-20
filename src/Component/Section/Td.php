<?php

namespace Ucscode\HtmlComponent\TableGenerator\Component\Section;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCell;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Td extends AbstractCell
{
    public function createElement(): ElementInterface
    {
        return $this->createDataOrientedElement(
            new ElementNode(NodeNameEnum::NODE_TD, $this->attributes),
            $this->data
        );
    }
}
