<?php

namespace Ucscode\HtmlComponent\TableGenerator\Component;

use Ucscode\HtmlComponent\TableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\TableGenerator\Traits\Constructor\TrConstructorTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\RenderableTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\TableComponentTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\TrCollectionTrait;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Tfoot implements TableComponentInterface
{
    use TableComponentTrait;
    use RenderableTrait;
    use TrCollectionTrait;
    use TrConstructorTrait;

    public function createElement(): ElementInterface
    {
        return $this->createTrOrientedElement(
            new ElementNode(NodeNameEnum::NODE_TFOOT, $this->attributes)
        );
    }
}
