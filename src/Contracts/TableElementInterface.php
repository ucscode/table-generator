<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

interface TableElementInterface extends RenderableInterface
{
    public function setName(?string $name): static;
    public function getName(): ?string;
}
