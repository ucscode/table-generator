<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

interface CellInterface extends TableComponentInterface
{
    public function getData(): mixed;
    public function setData(mixed $value): static;
}
