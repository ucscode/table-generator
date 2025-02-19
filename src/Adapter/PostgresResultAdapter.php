<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Adapter;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\AdapterInterface;

class PostgresResultAdapter implements AdapterInterface
{
    protected \PgSql\Result $result;

    public function __construct(\PgSql\Result $result)
    {
        $this->result = $result;
    }

    public function getColumns(): Tr
    {
        $thead = new Tr();
        $numFields = pg_num_fields($this->result);

        for ($i = 0; $i < $numFields; $i++) {
            $thead->addCell(new Th(pg_field_name($this->result, $i)));
        }

        return $thead;
    }

    public function getRows(): TrCollection
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
}
