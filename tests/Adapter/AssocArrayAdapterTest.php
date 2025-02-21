<?php

namespace Ucscode\HtmlComponent\TableGenerator\Test\Adapter;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\TableGenerator\Adapter\AssocArrayAdapter;
use Ucscode\Paginator\Paginator;

class AssocArrayAdapterTest extends TestCase
{
    protected const ASSOC_DATA = [
        [
            'ID' => 1,
            'Name' => 'John Doe',
            'Age' => 28,
            'Email' => 'john.doe@example.com',
            'Country' => 'USA',
        ],
        [
            'ID' => 2,
            'Name' => 'Jane Smith',
            'Age' => 34,
            'Email' => 'jane.smith@example.com',
            'Country' => 'Canada',
        ],
        [
            'ID' => 3,
            'Name' => 'Alice Johnson',
            'Age' => 25,
            'Email' => 'alice.johnson@example.com',
            'Country' => 'UK',
        ],
        [
            'ID' => 4,
            'Name' => 'Robert Brown',
            'Age' => 40,
            'Email' => 'robert.brown@example.com',
            'Country' => 'Australia',
        ],
        [
            'ID' => 5,
            'Name' => 'Emily Davis',
            'Age' => 22,
            'Email' => 'emily.davis@example.com',
            'Country' => 'Germany',
        ],
        [
            'ID' => 6,
            'Name' => 'Michael Wilson',
            'Age' => 30,
            'Email' => 'michael.wilson@example.com',
            'Country' => 'France',
        ],
        [
            'ID' => 7,
            'Name' => 'Sophia Martinez',
            'Age' => 27,
            'Email' => 'sophia.martinez@example.com',
            'Country' => 'Spain',
        ],
        [
            'ID' => 8,
            'Name' => 'David Anderson',
            'Age' => 35,
            'Email' => 'david.anderson@example.com',
            'Country' => 'Italy',
        ],
    ];

    #[DataProvider('paginatorProvider')]
    public function testAssocArrayAdapter(?Paginator $paginator, int $trItemsCount, array $data): void
    {
        $assocAdapter = new AssocArrayAdapter(self::ASSOC_DATA, $paginator);
        $paginator = $assocAdapter->getPaginator();

        $this->assertSame($paginator->getTotalItems(), count(self::ASSOC_DATA));
        $this->assertSame($assocAdapter->getTheadTr()->getCellCollection()->count(), 5);
        $this->assertSame($assocAdapter->getTbodyTrCollection()->count(), $trItemsCount);
        $this->assertSame($assocAdapter->getTbodyTrCollection()->get(0)?->getCell(0)?->getData(), $data[0]);
        $this->assertSame($assocAdapter->getTbodyTrCollection()->get(0)?->getCell(1)?->getData(), $data[1]);
    }

    public static function paginatorProvider(): array
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
