<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Contracts\CellInterface;

/**
 * @template TKey of int
 * @template TValue of CellInterface
 * @extends AbstractCollection<TKey, TValue>
 */
class CellCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return CellInterface::class;
    }
}
