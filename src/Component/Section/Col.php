<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\RenderableInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableFragmentTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Col implements RenderableInterface
{
    use TableFragmentTrait;
    use RenderableTrait;

    public function __construct()
    {
        $this->buildElement();
    }

    protected function buildElement(array|Attributes $attributes = []): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_COL, $attributes);
    }
}
