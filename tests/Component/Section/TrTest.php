<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test\Component\Section;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;

class TrTest extends TestCase
{
    public function testTrPlainRender(): void
    {
        $tr = new Tr();

        $this->assertSame($tr->render(), '<tr></tr>');
    }

    public function testTrCellRender(): void
    {
        $tr = (new Tr())
            ->addCell(new Th('Black'))
            ->addCell(new Td('White'))
        ;

        $this->assertSame($tr->render(), '<tr><th>Black</th><td>White</td></tr>');
    }

    public function testTrAttrCellAttrRender(): void
    {
        $tr = (new Tr(['id' => 'value-1']))
            ->addCell(new Th('Black', ['data-dev' => 'ucscode']))
            ->addCell(new Td('White', ['data-made-with' => 'love']))
        ;

        $this->assertSame($tr->render(), '<tr id="value-1"><th data-dev="ucscode">Black</th><td data-made-with="love">White</td></tr>');
    }
}