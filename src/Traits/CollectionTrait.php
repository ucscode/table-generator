<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Traits;

trait CollectionTrait
{
    protected array $items = [];

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
