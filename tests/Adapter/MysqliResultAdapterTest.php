<?php

namespace Ucscode\HtmlComponent\TableGenerator\Test\Adapter;

use mysqli_result;
use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\TableGenerator\Adapter\MysqliResultAdapter;
use Ucscode\Paginator\Paginator;

class MysqliResultAdapterTest extends TestCase
{
    public const MOCK_DATA = [
        [
            "id" => 1,
            "name" => "John Doe",
            "email" => "johndoe@example.com",
            "ip_address" => "192.168.1.1",
            "postalCode" => "10001"
        ],
        [
            "id" => 2,
            "name" => "Jane Smith",
            "email" => "janesmith@example.com",
            "ip_address" => "203.0.113.42",
            "postalCode" => "20002"
        ],
        [
            "id" => 3,
            "name" => "Alice Johnson",
            "email" => "alicejohnson@example.com",
            "ip_address" => "198.51.100.23",
            "postalCode" => "30303"
        ],
        [
            "id" => 4,
            "name" => "Bob Williams",
            "email" => "bobwilliams@example.com",
            "ip_address" => "172.16.0.15",
            "postalCode" => "40404"
        ],
        [
            "id" => 5,
            "name" => "Charlie Brown",
            "email" => "charliebrown@example.com",
            "ip_address" => "10.0.0.45",
            "postalCode" => "50505"
        ],
        [
            "id" => 6,
            "name" => "Diana Prince",
            "email" => "dianaprince@example.com",
            "ip_address" => "203.0.113.89",
            "postalCode" => "60606"
        ],
        null // Indicating an end of loop for fetch_assoc
    ];

    public function testTheadTrValues(): void
    {
        $result = $this->createMock(mysqli_result::class);

        $result
            ->method('data_seek')
            ->willReturn(true)
        ;

        $result
            ->method('fetch_assoc')
            ->willReturn(self::MOCK_DATA[0])
        ;

        $adapter = new MysqliResultAdapter($result);

        $columnContext = [
            ['id', 'Id'],
            ['name', 'Name'],
            ['email', 'Email'],
            ['ip_address', 'Ip Address'],
            ['postalCode', 'Postal Code'],
        ];

        $tr = $adapter->getTheadTr();

        foreach ($tr->getCellCollection() as $key => $cell) {
            $columnData = $columnContext[$key];
            $this->assertSame($columnData[0], $cell->getMeta()->get('originalValue'));
            $this->assertSame($columnData[0], $cell->getMeta()->get('columnName'));
            $this->assertSame($columnData[1], $cell->getData());
        }
    }

    public function testTbodyTrValues(): void
    {
        $result = $this->createMock(mysqli_result::class);

        $result
            ->method('data_seek')
            ->willReturn(true)
        ;

        $result
            ->method('fetch_assoc')
            ->willReturn(self::MOCK_DATA[0], ...self::MOCK_DATA)
        ;

        $adapter = new MysqliResultAdapter($result, new Paginator(count(self::MOCK_DATA)));
        $tbodyTrCollection = $adapter->getTbodyTrCollection();

        foreach ($tbodyTrCollection as $trIndex => $tr) {
            // Get a single associate array from the MOCK_DATA based on the index of the tr
            $mockData = self::MOCK_DATA[$trIndex];

            foreach ($tr->getCellCollection() as $cellIndex => $cell) {
                // Get the key relating to the cell in the associate array
                $mockDataColumnName = array_keys($mockData)[$cellIndex];

                // Get the value relating to the cell in the associate array
                $mockDataColumnValue = $mockData[$mockDataColumnName];

                $this->assertSame($mockDataColumnValue, $cell->getData());
                $this->assertSame($mockDataColumnValue, $cell->getMeta()->get('originalValue'));
                $this->assertSame($mockDataColumnName, $cell->getMeta()->get('columnName'));
            }
        }
    }
}
