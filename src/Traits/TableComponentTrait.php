<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Traits;

trait TableComponentTrait
{
    protected ?string $name = null;

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
