<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Adapter\ArrayAdapter;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Grid\Columns;
use Ucscode\HtmlComponent\HtmlTableGenerator\HtmlTableGenerator;

class TableCompositionTest extends TestCase
{
    public function testTableComposition(): void
    {
        $columns = new Columns();
        $columns
            ->addCell(new Td('value'))
            ->addCell(new Th('Value'), 'name')
        ;

        $adapter = new ArrayAdapter([]);
        $adapter = new MysqlResultAdapter([]);
        $adapter = new DoctrineResultAdapter([]);

        $generator = new HtmlTableGenerator($adapter, $columns);
        // $generator->render();
    }
}