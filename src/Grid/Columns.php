<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Grid;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CellCollectionTrait;
use Ucscode\UssElement\Contracts\CollectionInterface;

class Columns implements CollectionInterface
{
    use CellCollectionTrait;

    private int $lastIndex = -1;

    public function __construct(array $columns = [])
    {
        $this->items = array_values(array_map(fn ($value) => $this->createCell($value), $columns));
    }

    public function add(CellInterface|string $value, ?string $name = null): static
    {
        $this->items[] = $this->createCell($value, $name);

        return $this;
    }

    protected function createCell(CellInterface|string $value, ?string $name = null): CellInterface
    {
        if (!$value instanceof CellInterface) {
            $value = new Th($value);
        }

        if ($name === null) {
            $name = sprintf('column.%s', ++$this->lastIndex);
        }

        $value->setName($name);

        return $value;
    }
}
