<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Caption;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\ColGroup;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Tbody;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Tfoot;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Thead;
use Ucscode\HtmlComponent\HtmlTableGenerator\Table;

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
