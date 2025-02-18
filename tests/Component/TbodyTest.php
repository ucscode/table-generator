<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test\Component;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Tbody;

class TbodyTest extends TestCase
{
    public function testTbodyPlainRender(): void
    {
        $tbody = new Tbody();

        $this->assertSame($tbody->render(), '<tbody></tbody>');
    }

    public function testTbodyTrRender(): void
    {
        $tbody = (new Tbody())
            ->addTr(new Tr())
            ->addTr(new Tr())
        ;

        $this->assertSame($tbody->render(), '<tbody><tr></tr><tr></tr></tbody>');
    }

    public function testTbodyTrTdRender(): void
    {
        $tbody = (new Tbody())
            ->addTr(
                (new Tr())
                    ->addCell(new Th('data-1.1'))
                    ->addCell(new Td('data-1.2'))
            )
            ->addTr(
                (new Tr())
                    ->addCell(new Td('data-2.1'))
            )
        ;

        $this->assertSame($tbody->render(), '<tbody><tr><th>data-1.1</th><td>data-1.2</td></tr><tr><td>data-2.1</td></tr></tbody>');
    }

    public function testTbodyTrTdWithAttributes(): void
    {
        $tbody = (new Tbody(['name' => 'value']))
            ->addTr(
                (new Tr(['param' => 1]))
                    ->addCell(new Td('Excellent', ['is-true' => 'false']))
            )
            ->addTr(new Tr())
        ;

        $tbody->getAttributes()->set('node', 'not-js');

        $this->assertSame(
            $tbody->render(),
            '<tbody name="value" node="not-js"><tr param="1"><td is-true="false">Excellent</td></tr><tr></tr></tbody>'
        );
    }
}
