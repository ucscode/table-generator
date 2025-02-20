<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\ArbitraryDataInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableComponentTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\DataTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
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
