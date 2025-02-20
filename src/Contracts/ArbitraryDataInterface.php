<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

interface ArbitraryDataInterface
{
    public function getData(): mixed;
    public function setData(mixed $data): static;
}
