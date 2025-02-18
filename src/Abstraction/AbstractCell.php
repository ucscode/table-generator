<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\RenderableInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\ValueTrait;

abstract class AbstractCell implements CellInterface, RenderableInterface
{
    use ValueTrait;
}
