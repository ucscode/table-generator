<?php

namespace Ucscode\HtmlComponent\TableGenerator\Abstraction;

use Ucscode\HtmlComponent\TableGenerator\Contracts\CollectionInterface;
use Ucscode\HtmlComponent\TableGenerator\Traits\CollectionTrait;

/**
 * @template TKey of int
 * @template TValue
 * @implements CollectionInterface<TKey, TValue>
 */
abstract class AbstractCollection implements CollectionInterface
{
    use CollectionTrait;

    /**
     * @return class-string<TValue>
     */
    abstract protected function getCollectionType(): string;

    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->applyTypeCheckConstraint($item);
        }

        $this->items = $items;
    }

    /**
     * @param integer $index
     * @return TValue|null
     */
    public function get(int $index): ?object
    {
        return $this->items[$index] ?? null;
    }

    /**
     * @param TValue $item
     * @return boolean
     */
    public function has(object $item): bool
    {
        $this->applyTypeCheckConstraint($item);

        return in_array($item, $this->items, true);
    }

    /**
     * @param TValue $item
     * @return integer|boolean
     */
    public function indexOf(object $item): int|bool
    {
        $this->applyTypeCheckConstraint($item);

        return array_search($item, $this->items, true);
    }

    /**
     * @param TValue $item
     * @return static
     */
    public function prepend(object $item): static
    {
        $this->applyTypeCheckConstraint($item);

        if ($this->has($item)) {
            $this->remove($item);
        }

        array_unshift($this->items, $item);

        return $this;
    }

    /**
     * @param TValue $item
     * @return static
     */
    public function append(object $item): static
    {
        $this->applyTypeCheckConstraint($item);

        if ($this->has($item)) {
            $this->remove($item);
        }

        $this->items[] = $item;

        return $this;
    }

    /**
     * @param integer $index
     * @param TValue $item
     * @return static
     */
    public function insertAt(int $index, object $item): static
    {
        $this->applyTypeCheckConstraint($item);

        if ($this->has($item)) {
            $this->remove($item);
        }

        array_splice($this->items, $index, 0, [$item]);

        return $this;
    }

    /**
     * @param TValue|integer $item
     * @return static
     */
    public function remove(object|int $item): static
    {
        if (!is_int($item)) {
            $this->applyTypeCheckConstraint($item);
            $item = $this->indexOf($item);
        }

        if ($item !== false) {
            /** @var int $item */
            if (array_key_exists($item, $this->items)) {
                unset($this->items[$item]);
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    /**
     * @return TValue|null
     */
    public function first(): ?object
    {
        return $this->get(0);
    }

    /**
     * @return TValue|null
     */
    public function last(): ?object
    {
        return $this->get(count($this->items) - 1);
    }

    /**
     * @param TValue $item
     * @return void
     * @throws \InvalidArgumentException If invalid object type is received
     */
    protected function applyTypeCheckConstraint(mixed $item): void
    {
        if (!is_a($item, $this->getCollectionType(), true)) {
            throw new \InvalidArgumentException(
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
