<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Collection\CellCollection;

class Tr
{
    protected CellCollection $cellCollection;

    public function __construct()
    {
        $this->cellCollection = new CellCollection();
    }
}
