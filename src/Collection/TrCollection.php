<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;

/**
 * @template TKey of int
 * @template TValue of Tr
 * @extends AbstractCollection<TKey, TValue>
 */
class TrCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return Tr::class;
    }
}
