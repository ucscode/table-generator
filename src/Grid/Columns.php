<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Grid;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CellCollectionTrait;
use Ucscode\UssElement\Contracts\CollectionInterface;

class Columns implements CollectionInterface
{
    use CellCollectionTrait;

    public function __construct(array $columns = [])
    {
        $this->items = array_values(array_map(fn ($value) => $this->createCell($value), $columns));
    }

    public function add(CellInterface|string $value): static
    {
        $this->items[] = $this->createCell($value);

        return $this;
    }

    protected function createCell(CellInterface|string $value): CellInterface
    {
        if (!$value instanceof CellInterface) {
            $value = new Th($value);
        }

        return $value;
    }
}