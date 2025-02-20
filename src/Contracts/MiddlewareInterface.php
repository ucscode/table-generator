<?php

namespace Ucscode\HtmlComponent\TableGenerator\Contracts;

use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;

interface MiddlewareInterface
{
    public function alterTr(Tr $tr): Tr;
}
