<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

use Ucscode\HtmlComponent\HtmlTableGenerator\Support\ParameterBag;

interface TableComponentInterface extends RenderableInterface
{
    public function getParameters(): ParameterBag;
}
