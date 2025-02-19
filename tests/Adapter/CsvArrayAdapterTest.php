<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test\Adapter;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Adapter\CsvArrayAdapter;

class CsvArrayAdapterTest extends TestCase
{
    protected const CSV_DATA = [
        ['ID', 'Name', 'Age', 'Email'],
        [1, 'John Doe', 28, 'john.doe@example.com'],
        [2, 'Jane Smith', 34, 'jane.smith@example.com'],
        [3, 'Alice Johnson', 25, 'alice.johnson@example.com'],
    ];

    public function testCsvArrayAdapter(): void
    {
        $csvAdapter = new CsvArrayAdapter(self::CSV_DATA);
        $paginator = $csvAdapter->getPaginator();

        $this->assertSame($paginator->getTotalItems(), 3);
        $this->assertSame($csvAdapter->getTbodyTrCollection()->count(), 3);
        $this->assertSame($csvAdapter->getTheadTr()->getCellCollection()->count(), 4);
    }
}
