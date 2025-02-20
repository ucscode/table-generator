<?php

namespace Ucscode\HtmlComponent\TableGenerator\Adapter;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractAdapter;
use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;

class PostgresResultAdapter extends AbstractAdapter
{
    protected \PgSql\Result $result;

    public function __construct(\PgSql\Result $result)
    {
        $this->result = $result;
    }

    public function getTheadTr(): Tr
    {
        $thead = new Tr();
        $numFields = pg_num_fields($this->result);

        for ($i = 0; $i < $numFields; $i++) {
            $thead->addCell(new Th(pg_field_name($this->result, $i)));
        }

        return $thead;
    }

    public function getTbodyTrCollection(): TrCollection
    {
        $tbodyRows = new TrCollection();

        while ($row = pg_fetch_assoc($this->result)) {
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

    }
}
