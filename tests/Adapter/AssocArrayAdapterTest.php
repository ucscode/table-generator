<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test\Adapter;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Adapter\AssocArrayAdapter;

class AssocArrayAdapterTest extends TestCase
{
    protected const ASSOC_DATA = [
        [
            'ID' => 1,
            'Name' => 'John Doe',
            'Age' => 28,
            'Email' => 'john.doe@example.com',
        ],
        [
            'ID' => 2,
            'Name' => 'Jane Smith',
            'Age' => 34,
            'Email' => 'jane.smith@example.com',
        ],
        [
            'ID' => 3,
            'Name' => 'Alice Johnson',
            'Age' => 25,
            'Email' => 'alice.johnson@example.com',
        ],
    ];

    public function testAssocArrayAdapter(): void
    {
        $assocAdapter = new AssocArrayAdapter(self::ASSOC_DATA);
        $paginator = $assocAdapter->getPaginator();

        $this->assertSame($paginator->getTotalItems(), 3);
        $this->assertSame($assocAdapter->getTbodyTrCollection()->count(), 3);
        $this->assertSame($assocAdapter->getTheadTr()->getCellCollection()->count(), 4);
    }
}
