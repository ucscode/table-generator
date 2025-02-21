<?php

namespace Ucscode\HtmlComponent\TableGenerator\Abstraction;

use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\TableGenerator\Contracts\MiddlewareInterface;
use Ucscode\HtmlComponent\TableGenerator\Contracts\TableSegmentInterface;
use Ucscode\HtmlComponent\TableGenerator\Table;

abstract class AbstractMiddleware implements MiddlewareInterface
{
    /**
     * Iterate all cell that exists on the table
     *
     * @param Table $table
     * @param callable(CellInterface, Tr, TableSegmentInterface) $callback
     * @return void
     */
    protected function iterateCellsIn(Table $table, callable $callback)
    {
        $this->iterateTrsIn($table, function (Tr $tr, TableSegmentInterface $segment) use ($callback) {
            foreach ($tr->getCellCollection() as $cell) {
                call_user_func($callback, $cell, $tr, $segment);
            }
        });
    }

    /**
     * Iterate all Tr in the provided Table component
     *
     * @param Table $table
     * @param callable(Tr, TableSegmentInterface): void $callback
     * @return void
     */
    protected function iterateTrsIn(Table $table, callable $callback)
    {
        if ($thead = $table->getThead()) {
            foreach ($thead->getTrCollection() as $tr) {
                call_user_func($callback, $tr, $thead);
            }
        }

        $tbodyCollection = $table->getTbodyCollection();

        foreach ($tbodyCollection as $tbody) {
            foreach ($tbody->getTrCollection() as $tr) {
                call_user_func($callback, $tr, $tbody);
            }
        }

        if ($tfoot = $table->getTfoot()) {
            foreach ($tfoot->getTrCollection() as $tr) {
                call_user_func($callback, $tr, $tfoot);
            }
        }
    }
}
