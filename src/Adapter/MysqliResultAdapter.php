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
        $thead = new Tr();

        $this->data->data_seek(0); // Reset pointer

        if ($firstRow = $this->data->fetch_assoc()) {
            foreach (array_keys($firstRow) as $columnName) {
                $thead->addCell(new Th($columnName));
            }
        }

        return $thead;
    }

    public function getTbodyTrCollection(): TrCollection
    {
        $tbodyRows = new TrCollection();

        $this->data->data_seek($this->paginator->getCurrentPageOffset());

        for ($i = 0; $i < $this->paginator->getItemsPerPage(); $i++) {
            $row = $this->data->fetch_assoc();

            if (!$row) {
                break;
            }

            $tr = new Tr();

            foreach ($row as $value) {
                $tr->addCell(new Td($value));
            }

            $tbodyRows->add($tr);
        }

        return $tbodyRows;
    }

    protected function initialize(): void
    {
        if (!$this->data instanceof \mysqli_result) {
            throw new \InvalidArgumentException(
                sprintf('Data must be an instance of mysqli_result, %s given', get_debug_type($this->data))
            );
        }

        $this->paginator->setTotalItems($this->data->num_rows);
    }
}
