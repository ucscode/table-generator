<?php

namespace Ucscode\HtmlComponent\TableGenerator\Abstraction;

use Ucscode\HtmlComponent\TableGenerator\Contracts\ArbitraryDataInterface;
use Ucscode\HtmlComponent\TableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\TableGenerator\Traits\Constructor\DataConstructorTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\TableComponentTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\DataTrait;
use Ucscode\HtmlComponent\TableGenerator\Traits\RenderableTrait;

abstract class AbstractCell implements CellInterface, ArbitraryDataInterface
{
    use TableComponentTrait;
    use RenderableTrait;
    use DataTrait;
    use DataConstructorTrait;
}
