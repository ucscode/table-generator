<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

interface TableComponentInterface extends RenderableInterface
{
    public function setName(?string $name): static;
    public function getName(): ?string;
}
