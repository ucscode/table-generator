<?php

namespace Ucscode\HtmlComponent\TableGenerator\Test;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\TableGenerator\Component\Caption;
use Ucscode\HtmlComponent\TableGenerator\Component\ColGroup;
use Ucscode\HtmlComponent\TableGenerator\Component\Tbody;
use Ucscode\HtmlComponent\TableGenerator\Component\Tfoot;
use Ucscode\HtmlComponent\TableGenerator\Component\Thead;
use Ucscode\HtmlComponent\TableGenerator\Table;

class TableTest extends TestCase
{
    public function testTablePlainRender(): void
    {
        $table = new Table();

        $this->assertSame($table->render(), '<table></table>');
    }

    public function testTableWithPropertiesRender(): void
    {
        $table = new Table();
        $table->addTbody(new Tbody());
        $table->setTfoot(new Tfoot());
        $table->setCaption(new Caption('Caption'));
        $table->setThead(new Thead());
        $table->addColGroup(new ColGroup());
        $table->addTbody(new Tbody());

        $this->assertSame($table->render(), '<table><caption>Caption</caption><colgroup></colgroup><thead></thead><tbody></tbody><tbody></tbody><tfoot></tfoot></table>');
    }
}
