<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Adapter;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\AdapterInterface;

class MysqlResultAdapter implements AdapterInterface
{
    public function __construct(protected \mysqli_result $result)
    {
    }

    public function getColumns(): Tr
    {
        $thead = new Tr();

        $fields = $this->result->fetch_fields();

        foreach ($fields as $field) {
            $thead->addCell(new Th($field->name));
        }

        return $thead;
    }

    public function getRows(): TrCollection
    {
        $tbodyRows = new TrCollection();

        $this->result->data_seek(0); // Reset pointer

        while ($row = $this->result->fetch_assoc()) {
            $tr = new Tr();

            foreach ($row as $cell) {
                $tr->addCell(new Td((string)$cell));
            }

            $tbodyRows->add($tr);
        }

        return $tbodyRows;
    }
}
