<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableComponentTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\DataTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Caption implements TableComponentInterface
{
    use TableComponentTrait;
    use RenderableTrait;
    use DataTrait;

    public function __construct(mixed $data = null, array|Attributes $attributes = [])
    {
        $this->data = $data;
        $this->attributes = $attributes instanceof Attributes ? $attributes : new Attributes($attributes);
    }

    public function createElement(): ElementInterface
    {
        return $this->createDataOrientedElement(
            new ElementNode(NodeNameEnum::NODE_CAPTION, $this->attributes),
            $this->data
        );
    }
}
