<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Grid;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\ColumnsCollection;

class Rows
{
    protected ColumnsCollection $columnsCollection;

    public function __construct()
    {
        $this->columnsCollection = new ColumnsCollection();
    }

    public function getColumnsCollection(): ColumnsCollection
    {
        return $this->columnsCollection;
    }

    public function addColumns(Columns $columns): static
    {
        $this->columnsCollection->add($columns);

        return $this;
    }

    public function getColumns(int $index): ?ColumnsCollection
    {
        return $this->columnsCollection->get($index);
    }

    public function hasColumns(Columns $columns): bool
    {
        return $this->columnsCollection->has($columns);
    }

    public function removeColumns(int|Columns $columnsIdentity): static
    {
        $this->columnsCollection->remove($columnsIdentity);

        return $this;
    }

    public function indexOf(Columns $columns): int|bool
    {
        return $this->columnsCollection->indexOf($columns);
    }
}
