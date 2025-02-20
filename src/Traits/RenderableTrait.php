<?php

namespace Ucscode\HtmlComponent\TableGenerator\Traits;

use Ucscode\UssElement\Collection\Attributes;

trait RenderableTrait
{
    protected Attributes $attributes;

    public function __toString(): string
    {
        return $this->render();
    }

    public function render(?int $indent = null): string
    {
        return $this->createElement()->render($indent);
    }

    public function getAttributes(): Attributes
    {
        return $this->attributes;
    }

    public function setAttributes(Attributes $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }
}
