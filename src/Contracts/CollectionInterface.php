<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

use Ucscode\UssElement\Collection\ElementList;
use Ucscode\UssElement\Contracts\CollectionInterface as UssElementCollectionInterface;

interface CollectionInterface extends UssElementCollectionInterface
{
    public function getElementList(): ElementList;
    public function render(?int $indent): string;
}
