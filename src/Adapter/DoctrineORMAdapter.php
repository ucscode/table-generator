<?php

namespace Ucscode\HtmlComponent\TableGenerator\Adapter;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractAdapter;
use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;

class DoctrineORMAdapter extends AbstractAdapter
{
    protected array $data;

    public function __construct(Query|QueryBuilder $input)
    {
        if ($input instanceof QueryBuilder) {
            $input = $input->getQuery();
        }

        $this->data = $input->getResult(Query::HYDRATE_ARRAY);
    }

    public function getTheadTr(): Tr
    {
        $thead = new Tr();
        $headers = array_keys($this->data[0] ?? []);

        foreach ($headers as $header) {
            $thead->addCell(new Th($header));
        }

        return $thead;
    }

    public function getTbodyTrCollection(): TrCollection
    {
        $tbodyRows = new TrCollection();

        foreach ($this->data as $row) {
            $tr = new Tr();

            foreach ($row as $cell) {
                $tr->addCell(new Td($cell));
            }

            $tbodyRows->append($tr);
        }

        return $tbodyRows;
    }

    protected function initialize(): void
    {

    }
}
