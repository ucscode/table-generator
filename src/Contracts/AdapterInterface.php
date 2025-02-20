<?php

namespace Ucscode\HtmlComponent\TableGenerator\Contracts;

use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;
use Ucscode\Paginator\Paginator;

interface AdapterInterface
{
    public function getTheadTr(): Tr;
    public function getTbodyTrCollection(): TrCollection;
    public function getPaginator(): Paginator;
}
