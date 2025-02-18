<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableElementTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\ValueTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\NodeInterface;

abstract class AbstractCell implements CellInterface
{
    use TableElementTrait;
    use ValueTrait;

    public function __construct(string|NodeInterface $value, array|Attributes $attributes = [])
    {
        $this->buildElement($attributes);
    }
}
