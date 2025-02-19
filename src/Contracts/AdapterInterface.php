<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;

interface AdapterInterface
{
    public function getColumns(): Tr;
    public function getRows(): TrCollection;
}
