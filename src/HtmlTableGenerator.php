<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Tbody;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Thead;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\AdapterInterface;

class HtmlTableGenerator implements \Stringable
{
    protected Table $table;

    public function __construct(protected AdapterInterface $adapter)
    {
        $this->table = new Table();
        $this->processAdapter($adapter);
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function getTable(): Table
    {
        return $this->table;
    }

    public function render(): string
    {
        return $this->table->render();
    }

    protected function processAdapter(AdapterInterface $adapter): void
    {
        $thead = (new Thead())
            ->addTr($adapter->getColumns())
        ;

        $tbody = new Tbody();

        foreach ($adapter->getRows()->toArray() as $tr) {
            $tbody->addTr($tr);
        }

        $this->table
            ->setThead($thead)
            ->addTbody($tbody)
        ;
    }
}
