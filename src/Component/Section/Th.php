<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction\AbstractCell;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Th extends AbstractCell
{
    public function createElement(): ElementInterface
    {
        return $this->createDataOrientedElement(
            new ElementNode(NodeNameEnum::NODE_TH, $this->attributes),
            $this->data
        );
    }
}
