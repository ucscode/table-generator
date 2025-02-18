<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Adapter;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\AdapterInterface;

/**
 * An array of associative arrays where each sub-array represents a row with keys as column headers.
 */
class AssocArrayAdapter implements AdapterInterface
{
    /**
     * @param array<int,array<string,mixed>> $data
     */
    public function __construct(protected array $data)
    {
    }

    public function getTheadRow(): Tr
    {
        $thead = new Tr();

        foreach (array_keys($this->data[0]) as $value) {
            $thead->addCell(new Th($value));
        }

        return $thead;
    }

    public function getTBodyRows(): TrCollection
    {
        $tbodyRows = new TrCollection();

        foreach ($this->data as $row) {
            $tr = new Tr();

            foreach ($row as $cell) {
                $tr->addCell(new Td($cell));
            }

            $tbodyRows->add($tr);
        }

        return $tbodyRows;
    }
}
