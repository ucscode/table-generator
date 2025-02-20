<?php

namespace Ucscode\HtmlComponent\TableGenerator\Abstraction;

use Ucscode\HtmlComponent\TableGenerator\Contracts\ArbitraryDataInterface;
use Ucscode\HtmlComponent\TableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\TableGenerator\Traits\TableComponentTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\DataTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\RenderableTrait;
use Ucscode\UssElement\Collection\Attributes;

abstract class AbstractCell implements CellInterface, ArbitraryDataInterface
{
    use TableComponentTrait;
    use RenderableTrait;
    use DataTrait;

    /**
     * @param NodeInterface|RenderableInterface|string $data
     */
    public function __construct(mixed $data = null, array|Attributes $attributes = [])
    {
        $this->data = $data;
        $this->attributes = $attributes instanceof Attributes ? $attributes : new Attributes($attributes);
    }
}
