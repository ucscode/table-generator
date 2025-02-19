<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;
use Ucscode\Paginator\Paginator;

interface AdapterInterface
{
    public function getTheadTr(): Tr;
    public function getTbodyTrCollection(): TrCollection;
    public function getPaginator(): Paginator;
}
