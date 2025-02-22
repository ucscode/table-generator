<?php

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractMiddleware;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\TableGenerator\Contracts\TableSegmentInterface;
use Ucscode\HtmlComponent\TableGenerator\Table;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class CheckboxMiddleware extends AbstractMiddleware
{
    public function process(Table $table): Table
    {
        $this->iterateTrsIn($table, function(Tr $tr, TableSegmentInterface $segment) {
            // get index of the table row
            $index = $segment->indexOf($tr);

            // create a checkbox element
            $checkbox = $this->createCheckbox($index); // use string if prefered

            // create a cell and add the checkbox to it
            $td = new Td($checkbox);

            // add it to the beginning of each table row
            $tr->getCellCollection()->prepend($td);
        });

        return $table;
    }

    // create bootstrap checkbox
    // return a string if prefered
    protected function createCheckbox(int $index): ElementNode
    {
        $wrapper = new ElementNode(NodeNameEnum::NODE_DIV, ['class' => 'form-check']);

        $input = new ElementNode(NodeNameEnum::NODE_INPUT, [
            'class' => 'form-check-input',
            'type' => 'checkbox',
            'id' => 'checkbox-' . $index
        ]);

        $wrapper->appendChild($input);

        return $wrapper;
    }
}