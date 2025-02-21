<?php

namespace Ucscode\HtmlComponent\TableGenerator\Abstraction;

use Ucscode\HtmlComponent\TableGenerator\Contracts\CollectionInterface;
use Ucscode\HtmlComponent\TableGenerator\Exception\InvalidTableComponentException;
use Ucscode\HtmlComponent\TableGenerator\Traits\CollectionTrait;

abstract class AbstractCollection implements CollectionInterface
{
    use CollectionTrait;

    abstract protected function getCollectionType(): string;

    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->applyTypeCheckConstraint($item);
        }

        $this->items = $items;
    }

    protected function applyTypeCheckConstraint(mixed $item): void
    {
        if (!is_a($item, $this->getCollectionType(), true)) {
            throw new InvalidTableComponentException(
                sprintf(
                    '%s received an item of type %s, but only instances of %s are allowed.',
                    static::class,
                    get_debug_type($item),
                    $this->getCollectionType()
                )
            );
        }
    }
}
