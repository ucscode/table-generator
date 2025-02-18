<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableElementInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableElementTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TrCollectionTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Tbody implements TableElementInterface
{
    use TableElementTrait;
    use TrCollectionTrait;

    public function __construct()
    {
        $this->buildElement();
    }

    protected function buildElement(array|Attributes $attributes = []): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_TBODY, $attributes);
    }
}
