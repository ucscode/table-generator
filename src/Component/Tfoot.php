<?php

namespace Ucscode\HtmlComponent\TableGenerator\Component;

use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\TableGenerator\Traits\RenderableTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\TableComponentTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\TrCollectionTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Tfoot implements TableComponentInterface
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
            new ElementNode(NodeNameEnum::NODE_TFOOT, $this->attributes)
        );
    }
}
