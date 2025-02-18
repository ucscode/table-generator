<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction\AbstractCell;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Td extends AbstractCell
{
    public function createElement(): ElementInterface
    {
        return $this->renderLogic(
            new ElementNode(NodeNameEnum::NODE_TD, $this->attributes),
            $this->data
        );
    }
}
