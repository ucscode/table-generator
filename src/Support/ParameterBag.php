<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Support;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CollectionInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CollectionTrait;

/**
 * Store custom information
 */
class ParameterBag implements CollectionInterface
{
    use CollectionTrait;

    public function set(string $name, mixed $value): static
    {
        $this->items[$name] =  $value;

        return $this;
    }

    public function get(string $name, mixed $default = null): mixed
    {
        return $this->items[$name] ?? $default;
    }

    public function remove(string $name): static
    {
        if (array_key_exists($name, $this->items)) {
            unset($this->items[$name]);
        }

        return $this;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->items);
    }
}
