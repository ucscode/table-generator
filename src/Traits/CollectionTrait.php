<?php

namespace Ucscode\HtmlComponent\TableGenerator\Traits;

/**
 * @template TValue
 */
trait CollectionTrait
{
    /**
     * @var TValue[]
     */
    protected array $items = [];

    /**
     * @return TValue[]
     */
    public function toArray(): array
    {
        return $this->items;
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function sort(callable $callback): static
    {
        usort($this->items, $callback);

        return $this;
    }

    public function clear(): static
    {
        $this->items = [];

        return $this;
    }
}
