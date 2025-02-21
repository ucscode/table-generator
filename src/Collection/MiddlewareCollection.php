<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Contracts\MiddlewareInterface;

/**
 * @template TKey of int
 * @template TValue of MiddlewareInterface
 * @extends AbstractCollection<TKey, TValue>
 */
class MiddlewareCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return MiddlewareInterface::class;
    }
}
