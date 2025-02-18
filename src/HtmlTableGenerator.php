<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\AdapterInterface;

class HtmlTableGenerator
{
    protected Table $table;

    public function __construct(protected AdapterInterface $adapter)
    {

    }
}
