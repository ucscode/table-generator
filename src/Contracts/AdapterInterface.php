<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

use Ucscode\HtmlComponent\HtmlTableGenerator\Grid\Columns;
use Ucscode\HtmlComponent\HtmlTableGenerator\Grid\Rows;

interface AdapterInterface
{
    public function getColumns(): Columns;
    public function getRows(): Rows;
}
