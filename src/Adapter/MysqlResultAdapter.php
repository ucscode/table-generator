<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Adapter;

use Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction\AbstractAdapter;
use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;

class MysqlResultAdapter extends AbstractAdapter
{
    public function __construct(protected \mysqli_result $result)
    {
    }

    public function getTheadTr(): Tr
    {
        $thead = new Tr();

        $fields = $this->result->fetch_fields();

        foreach ($fields as $field) {
            $thead->addCell(new Th($field->name));
        }

        return $thead;
    }

    public function getTbodyTrCollection(): TrCollection
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

    protected function initialize(): void
    {

    }
}
