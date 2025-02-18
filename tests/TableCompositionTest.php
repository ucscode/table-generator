<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Adapter\ArrayAdapter;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Grid\Columns;
use Ucscode\HtmlComponent\HtmlTableGenerator\HtmlTableGenerator;

class TableCompositionTest extends TestCase
{
    public function testTableComposition(): void
    {
        $columns = new Columns();
        $columns
            ->add('value')
            ->add(new Th('Value'), 'name')
        ;

        $columns->getByName('column.0');

        $adapter = new ArrayAdapter([]);
        $adapter = new MysqlResultAdapter([]);
        $adapter = new DoctrineResultAdapter([]);

        $generator = new HtmlTableGenerator($adapter, $columns);
        // $generator->render();
    }
}