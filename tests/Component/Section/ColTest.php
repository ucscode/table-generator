<?php

namespace Ucscode\HtmlComponent\TableGenerator\Test\Component\Section;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Col;

class ColTest extends TestCase
{
    public function testColRender(): void
    {
        $col = new Col();

        $this->assertSame($col->render(), '<col/>');
    }

    public function testColWithAttributesRender(): void
    {
        $col = new Col([
            'class' => 'col-class',
            'style' => 'color: green;',
        ]);

        $this->assertSame($col->render(), '<col class="col-class" style="color: green;"/>');
    }
}
