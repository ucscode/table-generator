<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Adapter;

use Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction\AbstractAdapter;
use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;

/**
 * An array of associative arrays where each sub-array represents a row with keys as column headers.
 *
 * @property array<int,array<string,mixed>> $data
 */
class AssocArrayAdapter extends AbstractAdapter
{
    public function getTheadTr(): Tr
    {
        $thead = new Tr();

        foreach (array_keys($this->data[0]) as $value) {
            $thead->addCell(new Th($value));
        }

        return $thead;
    }

    public function getTbodyTrCollection(): TrCollection
    {
        $tbodyRows = new TrCollection();

        $data = array_slice(
            $this->data,
            $this->paginator->getCurrentPageOffset(),
            $this->paginator->getItemsPerPage(),
        );

        foreach ($data as $row) {
            $tr = new Tr();

            foreach ($row as $cell) {
                $tr->addCell(new Td($cell));
            }

            $tbodyRows->add($tr);
        }

        return $tbodyRows;
    }

    protected function initialize(): void
    {
        if (!is_array($this->data)) {
            throw new \InvalidArgumentException(sprintf('Data must be of type array, %s given', gettype($this->data)));
        }

        $this->paginator->setTotalItems(count($this->data));
    }
}
