<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\RenderableInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\ValueTrait;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Caption implements TableComponentInterface, RenderableInterface
{
    use ValueTrait;
    use RenderableTrait;

    public function __construct()
    {
        $this->buildElement();
    }

    protected function buildElement(): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_CAPTION);
    }
}
