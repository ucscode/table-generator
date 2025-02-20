<?php

namespace Ucscode\HtmlComponent\TableGenerator\Abstraction;

use Ucscode\HtmlComponent\TableGenerator\Contracts\CollectionInterface;
use Ucscode\HtmlComponent\TableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\TableGenerator\Exception\InvalidTableComponentException;
use Ucscode\HtmlComponent\TableGenerator\Traits\CollectionTrait;

abstract class AbstractCollection implements CollectionInterface
{
    use CollectionTrait;

    abstract protected function getCollectionType(): string;

    /**
     * @param TableComponentInterface[] $items
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            if (!is_a($item, $this->getCollectionType(), true)) {
                throw new InvalidTableComponentException(
                    sprintf(
                        '%s::__construct() received an item of type %s, but only instances of %s are allowed.',
                        static::class,
                        get_debug_type($item),
                        $this->getCollectionType()
                    )
                );
            }
        }

        $this->items = $items;
    }
}
