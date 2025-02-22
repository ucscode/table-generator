<?php

namespace Ucscode\HtmlComponent\TableGenerator\Test\Support;

use PHPUnit\Framework\TestCase;
use stdClass;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Td;

class MetaTest extends TestCase
{
    public function testMetaMethods(): void
    {
        $td = new Td('A cell data', [
            'name' => 'attribute'
        ]);

        $td->getMeta()
            ->set('secretKey', 'so-secret')
            ->set('array', [])
            ->set('object', new stdClass())
        ;

        $this->assertSame($td->render(), '<td name="attribute">A cell data</td>');
        $this->assertTrue($td->getMeta()->has('secretKey'));
        $this->assertSame($td->getMeta()->get('secretKey'), 'so-secret');
        $this->assertSame($td->getMeta()->get('array'), []);
        $this->assertInstanceOf(stdClass::class, $td->getMeta()->get('object'));
        $this->assertSame($td->getMeta()->get('agent'), null);
        $this->assertSame($td->getMeta()->get('agent', 'John Doe'), 'John Doe');

        $td->getMeta()->remove('array');

        $this->assertFalse($td->getMeta()->has('array'));
        $this->assertCount(2, $td->getMeta());
    }
}
