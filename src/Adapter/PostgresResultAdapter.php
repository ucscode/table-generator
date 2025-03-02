<?php

namespace Ucscode\HtmlComponent\TableGenerator\Adapter;

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractAdapter;
use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;

// This Adapter has not been properly developed.
// Working on it
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
            $columnName = pg_field_name($this->result, $i);
            $cell = new Th();
            $cell->getMeta()
                ->set('originalValue', $columnName)
                ->set('columnName', $columnName)
            ;
            $cell->setData(ucwords(str_replace('_', ' ', $columnName)));
            $thead->addCell($cell);
        }

        return $thead;
    }

    public function getTbodyTrCollection(): TrCollection
    {
        $headTr = $this->getTheadTr();
        $tbodyRows = new TrCollection();

        while ($row = pg_fetch_assoc($this->result)) {
            $tr = new Tr();

            foreach (array_values($row) as $key => $value) {
                /**
                 * Get Th that matches the same index as the Td
                 * @var ?Th $headerCell
                 */
                $headerCell = $headTr->getCellCollection()->get($key);

                $cell = new Td($value);
                $cell->getMeta()
                    ->set('originalValue', $value)
                    ->set('columnName', $headerCell?->getMeta()->get('columnName'))
                ;

                $tr->addCell($cell);
            }

            $tbodyRows->append($tr);
        }

        return $tbodyRows;
    }

    protected function initialize(): void
    {

    }
}
