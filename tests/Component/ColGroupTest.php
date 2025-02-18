<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test\Component;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\ColGroup;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Col;

class ColGroupTest extends TestCase
{
    public function testColGroupPlainRender(): void
    {
        $colGroup = new ColGroup();

        $this->assertSame($colGroup->render(), '<colgroup></colgroup>');
    }

    public function testColGroupColsRender(): void
    {
        $colGroup = new ColGroup();
        $colGroup
            ->addCol(new Col())
            ->addCol(new Col())
        ;

        $this->assertSame($colGroup->render(), '<colgroup><col/><col/></colgroup>');
    }

    public function testColGroupColsAttributesRender(): void
    {
        $colGroup = new ColGroup([
            'data-name' => 'value-1',
            'data-name' => 'value-2',
            'data-Name' => 'value-3',
        ]);

        $colGroup
            ->addCol(new Col(['data-col' => 'col-1']))
            ->addCol(new Col(['data-col' => 'col-2']))
        ;

        $this->assertSame($colGroup->render(), '<colgroup data-name="value-3"><col data-col="col-1"/><col data-col="col-2"/></colgroup>');
    }
}
