<?php

namespace Ucscode\HtmlComponent\TableGenerator\Adapter;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractAdapter;
use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;

/**
 * A two-dimensional array where the first sub-array is the header row, and the remaining sub-arrays are data rows.
 *
 * @property array<int,string[]> $data
 */
class CsvArrayAdapter extends AbstractAdapter
{
    public function getTheadTr(): Tr
    {
        $theadTr = new Tr();

        foreach ($this->data[0] ?? [] as $value) {
            $cell = new Th();
            $cell->getMeta()
                ->set('originalValue', $value)
                ->set('columnName', $value)
            ;
            $cell->setData($this->toTitleCase($value));
            $theadTr->addCell($cell);
        }

        return $theadTr;
    }

    public function getTbodyTrCollection(): TrCollection
    {
        $headTr = $this->getTheadTr();
        $trCollection = new TrCollection();

        $data = array_slice(
            $this->data,
            $this->paginator->getCurrentPageOffset() + 1,
            $this->paginator->getItemsPerPage(),
        );

        foreach ($data as $row) {
            $tr = new Tr();

            foreach (array_values($row) as $key => $value) {
                /**
                 * Get Th that matches the same index as the Td
                 * @var ?Th $headCell
                 */
                $headCell = $headTr->getCellCollection()->get($key);

                $cell = new Td($value);
                $cell->getMeta()
                    ->set('originalValue', $value)
                    ->set('columnName', $headCell?->getMeta()->get('columnName'))
                ;

                $tr->addCell($cell);
            }

            $trCollection->append($tr);
        }

        return $trCollection;
    }

    protected function initialize(): void
    {
        if (!is_array($this->data)) {
            throw new \InvalidArgumentException(sprintf('Data must be of type array, %s given', gettype($this->data)));
        }

        $this->paginator->setTotalItems(count($this->data) - 1);
    }
}
