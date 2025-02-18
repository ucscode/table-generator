<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableComponentTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TrCollectionTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Tbody implements TableComponentInterface
{
    use TableComponentTrait;
    use RenderableTrait;
    use TrCollectionTrait;

    public function __construct(array|Attributes $attributes = [])
    {
        $this->trCollection = new TrCollection();
        $this->attributes = $attributes instanceof Attributes ? $attributes : new Attributes($attributes);
    }

    public function createElement(): ElementInterface
    {
        return $this->createTrOrientedElement(
            new ElementNode(NodeNameEnum::NODE_TBODY, $this->attributes)
        );
    }
}
