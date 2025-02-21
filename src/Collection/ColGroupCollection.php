<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\ColGroup;

/**
 * @template TKey of int
 * @template TValue of ColGroup
 * @extends AbstractCollection<TKey, TValue>
 */
class ColGroupCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return ColGroup::class;
    }
}
