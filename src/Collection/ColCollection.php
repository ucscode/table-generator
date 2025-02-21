<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Col;

/**
 * @template TKey of int
 * @template TValue of Col
 * @extends AbstractCollection<TKey, TValue>
 */
class ColCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return Col::class;
    }
}
