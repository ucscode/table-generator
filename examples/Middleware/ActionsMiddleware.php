<?php

use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractMiddleware;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\TableGenerator\Component\Tbody;
use Ucscode\HtmlComponent\TableGenerator\Contracts\TableSegmentInterface;
use Ucscode\HtmlComponent\TableGenerator\Table;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;
use Ucscode\UssElement\Node\TextNode;

class ActionsMiddleware extends AbstractMiddleware
{
    public function process(Table $table): Table
    {
        $this->iterateTrsIn($table, function(Tr $tr, TableSegmentInterface $segment) {
            if ($segment instanceof Tbody) {
                $td = new Td($this->createActions($tr));
            } else {
                $td = new Td('Action');
            }

            $tr->addCell($td);
        });

        return $table;
    }

    protected function createActions(): ElementNode
    {
        $wrapper = new ElementNode(NodeNameEnum::NODE_DIV);
        $editButton = new ElementNode(NodeNameEnum::NODE_BUTTON, ['class' => 'btn btn-primary']);
        $deleteButton = new ElementNode(NodeNameEnum::NODE_BUTTON, ['class' => 'btn btn-danger']);

        $editButton->appendChild(new TextNode('Edit'));
        $deleteButton->appendChild(new TextNode('Delete'));

        $wrapper->appendChild($editButton);
        $wrapper->appendChild($deleteButton);

        return $wrapper;
    }
}