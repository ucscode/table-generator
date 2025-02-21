<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Tbody;

/**
 * @template TKey of int
 * @template TValue of Tbody
 * @extends AbstractCollection<TKey, TValue>
 */
class TbodyCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return Tbody::class;
    }
}
