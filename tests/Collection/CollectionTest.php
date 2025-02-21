<?php

namespace Ucscode\HtmlComponent\TableGenerator\Test\Collection;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;

class CollectionTest extends TestCase
{
    public function testTrCollectionInvalidConstructorArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new TrCollection([new Td()]);
    }

    public function testTrCollectionInvalidSetterArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $trCollection = new TrCollection([new Tr()]);
        $trCollection->append(new Td());
    }

    #[DataProvider('tdProvider')]
    public function testTrCollectionAppend($tr1, $tr2, $tr3, $tr4): void
    {
        $trCollection = new TrCollection([$tr1, $tr2, $tr3]);

        $trCollection->append($tr4);

        $this->assertCount(4, $trCollection);
        $this->assertSame($trCollection->first(), $tr1);
        $this->assertSame($trCollection->last(), $tr4);

        $trCollection->prepend($tr3);

        $this->assertCount(4, $trCollection);
        $this->assertSame($trCollection->first(), $tr3);
        $this->assertSame($trCollection->last(), $tr4);

        $this->assertSame($trCollection->indexOf($tr1), 1);
        $this->assertSame($trCollection->indexOf($tr2), 2);

        $trCollection->insertAt(1, $tr4);

        $this->assertCount(4, $trCollection);
        $this->assertSame($trCollection->first(), $tr3);
        $this->assertSame($trCollection->last(), $tr2);

        $this->assertSame($trCollection->indexOf($tr1), 2);
        $this->assertSame($trCollection->indexOf($tr2), 3);
        $this->assertSame($trCollection->indexOf($tr3), 0);
        $this->assertSame($trCollection->indexOf($tr4), 1);

        $trCollection->remove($tr4);

        $this->assertSame($trCollection->indexOf($tr1), 1);
        $this->assertSame($trCollection->indexOf($tr2), 2);
        $this->assertSame($trCollection->indexOf($tr3), 0);
    }

    public static function tdProvider(): array
    {
        return [
            [new Tr(), new Tr(), new Tr(), new Tr()],
        ];
    }
}
