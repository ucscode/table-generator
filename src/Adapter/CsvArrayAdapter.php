<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Adapter;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\AdapterInterface;

/**
 * A two-dimensional array where the first sub-array is the header row, and the remaining sub-arrays are data rows.
 */
class CsvArrayAdapter implements AdapterInterface
{
    /**
     * @param array<int,string[]> $data
     */
    public function __construct(protected array $data)
    {
    }

    public function getColumns(): Tr
    {
        $thead = new Tr();

        foreach ($this->data[0] as $value) {
            $thead->addCell(new Th($value));
        }

        return $thead;
    }

    public function getRows(): TrCollection
    {
        $tbodyRows = new TrCollection();

        foreach (array_slice($this->data, 1) as $row) {
            $tr = new Tr();

            foreach ($row as $value) {
                $tr->addCell(new Td($value));
            }

            $tbodyRows->add($tr);
        }

        return $tbodyRows;
    }
}
