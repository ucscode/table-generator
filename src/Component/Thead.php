<?php

namespace Ucscode\HtmlComponent\TableGenerator\Component;

use Ucscode\HtmlComponent\TableGenerator\Contracts\TableSegmentInterface;
use Ucscode\HtmlComponent\TableGenerator\Traits\Constructor\TableSectionConstructorTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\RenderableTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\TableComponentTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\TrCollectionTrait;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Thead implements TableSegmentInterface
{
    use TableComponentTrait;
    use RenderableTrait;
    use TrCollectionTrait;
    use TableSectionConstructorTrait;

    public function createElement(): ElementInterface
    {
        return $this->createTrOrientedElement(
            new ElementNode(NodeNameEnum::NODE_THEAD, $this->attributes)
        );
    }
}
