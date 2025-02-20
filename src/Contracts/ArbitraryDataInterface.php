<?php

namespace Ucscode\HtmlComponent\TableGenerator\Contracts;

interface ArbitraryDataInterface
{
    public function getData(): mixed;
    public function setData(mixed $data): static;
}
