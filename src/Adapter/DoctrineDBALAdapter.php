<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Adapter;

use Doctrine\DBAL\Statement;
use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\AdapterInterface;

class DoctrineDBALAdapter implements AdapterInterface
{
    protected array $data;

    public function __construct(Statement $statement)
    {
        $this->data = $statement->fetchAllAssociative();
    }

    public function getColumns(): Tr
    {
        $thead = new Tr();
        $firstRow = $this->data[0] ?? [];

        $headers = array_keys($firstRow);

        foreach ($headers as $header) {
            $thead->addCell(new Th($header));
        }

        return $thead;
    }

    public function getRows(): TrCollection
    {
        $tbodyRows = new TrCollection();

        foreach ($this->data as $row) {
            $tr = new Tr();

            foreach ($row as $cell) {
                $tr->addCell(new Td($cell));
            }

            $tbodyRows->add($tr);
        }

        return $tbodyRows;
    }
}
