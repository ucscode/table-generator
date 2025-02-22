<?php

namespace Ucscode\HtmlComponent\TableGenerator\Support;

use Ucscode\HtmlComponent\TableGenerator\Contracts\CollectionInterface;
use Ucscode\HtmlComponent\TableGenerator\Traits\CollectionTrait;

class Meta implements CollectionInterface
{
    use CollectionTrait;

    public function set(string $name, mixed $value): static
    {
        $this->items[$name] = $value;

        return $this;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->items);
    }

    public function get(string $name, mixed $default = null): mixed
    {
        return $this->items[$name] ?? $default;
    }

    public function remove(string $name): static
    {
        if ($this->has($name)) {
            unset($this->items[$name]);
        }

        return $this;
    }
}
