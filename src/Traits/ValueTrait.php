<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Traits;

trait ValueTrait
{
    protected ?string $value = null;

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): static
    {
        $this->value = $value;

        return $this;
    }
}