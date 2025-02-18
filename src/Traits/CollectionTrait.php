<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Traits;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableComponentInterface;

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

    public function getComponentByName(string $name): ?TableComponentInterface
    {
        foreach ($this->items as $item) {
            if ($item instanceof TableComponentInterface) {
                if ($item->getName() === $name) {
                    return $item;
                }
            }
        }

        return null;
    }
}
