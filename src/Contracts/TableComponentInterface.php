<?php

namespace Ucscode\HtmlComponent\TableGenerator\Contracts;

use Ucscode\HtmlComponent\TableGenerator\Support\Meta;

interface TableComponentInterface extends RenderableInterface
{
    public function getMeta(): Meta;
}
