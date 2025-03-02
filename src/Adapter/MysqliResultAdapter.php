<?php

namespace Ucscode\HtmlComponent\TableGenerator\Adapter;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractAdapter;
use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;

/**
 * @property \mysqli_result $data
 */
class MysqliResultAdapter extends AbstractAdapter
{
    public function getTheadTr(): Tr
    {
        $theadTr = new Tr();

        $this->data->data_seek(0); // Reset pointer

        if ($firstRow = $this->data->fetch_assoc()) {
            foreach (array_keys($firstRow) as $columnName) {
                $cell = new Th();
                $cell->getMeta()
                    ->set('originalValue', $columnName)
                    ->set('columnName', $columnName)
                ;
                $cell->setData($this->toTitleCase($columnName));
                $theadTr->addCell($cell);
            }
        }

        return $theadTr;
    }

    public function getTbodyTrCollection(): TrCollection
    {
        $headTr = $this->getTheadTr();
        $trCollection = new TrCollection();
        $trIndex = 0;

        // Adjusts the result pointer to the index of the first item in the current page
        $this->data->data_seek($this->paginator->getCurrentPageOffset());

        // Proceed with fetching the rest of the items
        while ($row = $this->data->fetch_assoc()) {

            // If rows in the TrCollection is up to the items required per page, stop the iteration
            if ($trIndex >= $this->paginator->getItemsPerPage()) {
                break;
            }

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

            // Increase the item index number
            $trIndex++;
        }

        return $trCollection;
    }

    protected function initialize(): void
    {
        if (!$this->data instanceof \mysqli_result) {
            throw new \InvalidArgumentException(
                sprintf('Data must be an instance of mysqli_result, %s given', get_debug_type($this->data))
            );
        }

        // When stubbing, mysqli_result will always throw error "MockObject... is already closed"
        // So we need to set the total items of the Paginator before passing it to the __construct() method

        if (get_class($this->data) !== \mysqli_result::class) {
            return;
        }

        $this->paginator->setTotalItems($this->data->num_rows);
    }
}
