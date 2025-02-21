<?php

namespace Ucscode\HtmlComponent\TableGenerator\Contracts;

use Ucscode\HtmlComponent\TableGenerator\Table;

interface MiddlewareInterface
{
    public function process(Table $table): Table;
}
