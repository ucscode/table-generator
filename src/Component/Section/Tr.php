<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\CellCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\RenderableInterface;

class Tr implements RenderableInterface
{
    protected CellCollection $cellCollection;

    public function __construct()
    {
        $this->cellCollection = new CellCollection();
    }
}
