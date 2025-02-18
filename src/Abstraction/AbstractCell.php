<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\RenderableInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableFragmentTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\ValueTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\NodeInterface;

abstract class AbstractCell implements CellInterface, RenderableInterface
{
    use TableFragmentTrait;
    use ValueTrait;
    use RenderableTrait;

    public function __construct(string|NodeInterface $value, array|Attributes $attributes = [])
    {
        $this->buildElement($attributes);
    }
}
