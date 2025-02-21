<?php

namespace Ucscode\HtmlComponent\TableGenerator\Collection;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractCollection;
use Ucscode\HtmlComponent\TableGenerator\Contracts\MiddlewareInterface;

/**
 * @property MiddlewareInterface[] $items
 * @method MiddlewareInterface[] toArray()
 */
class MiddlewareCollection extends AbstractCollection
{
    public function add(MiddlewareInterface $middleware): static
    {
        if (!$this->has($middleware)) {
            $this->items[] = $middleware;
        }

        return $this;
    }

    public function get(int $index): ?MiddlewareInterface
    {
        return $this->items[$index] ?? null;
    }

    public function has(MiddlewareInterface $middleware): bool
    {
        return in_array($middleware, $this->items, true);
    }

    public function remove(MiddlewareInterface|int $middlewareIdentity): static
    {
        if ($middlewareIdentity instanceof MiddlewareInterface) {
            $middlewareIdentity = $this->indexOf($middlewareIdentity);
        }

        if ($middlewareIdentity !== false) {
            /** @var int $indexOrTr */
            if (array_key_exists($middlewareIdentity, $this->items)) {
                unset($this->items[$middlewareIdentity]);
                $this->items = array_values($this->items);
            }
        }

        return $this;
    }

    public function indexOf(MiddlewareInterface $middleware): int|bool
    {
        return array_search($middleware, $this->items, true);
    }

    protected function getCollectionType(): string
    {
        return MiddlewareInterface::class;
    }
}
