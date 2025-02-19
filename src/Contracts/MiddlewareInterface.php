<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;

interface MiddlewareInterface
{
    public function alterTr(Tr $tr): Tr;
}
