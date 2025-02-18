<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction\AbstractCell;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Th extends AbstractCell
{
    use RenderableTrait;

    public function __construct()
    {
        $this->buildElement();
    }

    protected function buildElement(): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_TH);
    }
}
