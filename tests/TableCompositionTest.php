<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Adapter\CsvArrayAdapter;
use Ucscode\HtmlComponent\HtmlTableGenerator\HtmlTableGenerator;

class TableCompositionTest extends TestCase
{
    public function testTableComposition(): void
    {
        $adapter = new CsvArrayAdapter([]);
        $adapter = new MysqlResultAdapter([]);
        $adapter = new DoctrineResultAdapter([]);

        $generator = new HtmlTableGenerator($adapter, $columns);
        // $generator->render();
    }
}