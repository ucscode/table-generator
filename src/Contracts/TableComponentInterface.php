<?php

namespace Ucscode\HtmlComponent\TableGenerator\Contracts;

use Ucscode\HtmlComponent\TableGenerator\Support\ParameterBag;

interface TableComponentInterface extends RenderableInterface
{
    public function getParameters(): ParameterBag;
}
