<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test\Adapter;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Adapter\CsvArrayAdapter;
use Ucscode\Paginator\Paginator;

class CsvArrayAdapterTest extends TestCase
{
    protected const CSV_DATA = [
        ['ID', 'Name', 'Age', 'Email', 'Country'],
        [1, 'John Doe', 28, 'john.doe@example.com', 'USA'],
        [2, 'Jane Smith', 34, 'jane.smith@example.com', 'Canada'],
        [3, 'Alice Johnson', 25, 'alice.johnson@example.com', 'UK'],
        [4, 'Robert Brown', 40, 'robert.brown@example.com', 'Australia'],
        [5, 'Emily Davis', 22, 'emily.davis@example.com', 'Germany'],
        [6, 'Michael Wilson', 30, 'michael.wilson@example.com', 'France'],
        [7, 'Sophia Martinez', 27, 'sophia.martinez@example.com', 'Spain'],
        [8, 'David Anderson', 35, 'david.anderson@example.com', 'Italy'],
    ];
    
    #[DataProvider('paginatorProvider')]
    public function testCsvArrayAdapter(?Paginator $paginator, int $trItemsCount, array $data): void
    {
        $csvAdapter = new CsvArrayAdapter(self::CSV_DATA, $paginator);
        $paginator = $csvAdapter->getPaginator();

        $this->assertSame($paginator->getTotalItems(), count(self::CSV_DATA) - 1);
        $this->assertSame($csvAdapter->getTheadTr()->getCellCollection()->count(), 5);
        $this->assertSame($csvAdapter->getTbodyTrCollection()->count(), $trItemsCount);
        $this->assertSame($csvAdapter->getTbodyTrCollection()->get(0)?->getCell(0)?->getData(), $data[0]);
        $this->assertSame($csvAdapter->getTbodyTrCollection()->get(0)?->getCell(1)?->getData(), $data[1]);
    }

    protected function paginatorProvider(): array
    {
        return [
            [null, 8, [1, 'John Doe']],
            [new Paginator(), 8, [1, 'John Doe']],
            [new Paginator(0, 2, 1), 2, [1, 'John Doe']],
            [new Paginator(0, 2, 2), 2, [3, 'Alice Johnson']],
            [new Paginator(0, 3, 2), 3, [4, 'Robert Brown']],
            [new Paginator(0, 7, 2), 1, [8, 'David Anderson']],
            [new Paginator(0, 5, 2), 3, [6, 'Michael Wilson']],
        ];
    }
}
