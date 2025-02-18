<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

interface CellInterface extends TableComponentInterface
{
    public function getValue(): ?string;
}
