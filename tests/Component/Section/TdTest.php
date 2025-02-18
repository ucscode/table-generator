<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test\Component\Section;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\HtmlTableGenerator\Table;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;
use Ucscode\UssElement\Node\TextNode;

class TdTest extends TestCase
{
    public function testTdPlainTextRender(): void
    {
        $td = new Td('John Doe');

        $this->assertSame($td->createElement()->getInnerHtml(), 'John Doe');
        $this->assertSame($td->render(), '<td>John Doe</td>');
    }

    public function testTdHtmlStringRender(): void
    {
        $td = new Td('<p>James Blunt</p>');

        $this->assertSame($td->createElement()->getInnerHtml(), '<p>James Blunt</p>');
        $this->assertSame($td->render(), '<td><p>James Blunt</p></td>');
    }

    public function testTdNodeInterfaceRender(): void
    {
        $node = new ElementNode(NodeNameEnum::NODE_DIV, [
            'id' => 'example'
        ]);

        $node->appendChild(new TextNode('Working Logic'));
        
        $td = new Td($node);

        $this->assertSame($td->createElement()->getInnerHtml(), $node->render());
        $this->assertSame($td->render(), '<td><div id="example">Working Logic</div></td>');
    }

    public function testTdInnerTableRender(): void
    {
        $td = new Td(new Td('Slim'));

        $this->assertSame($td->render(), '<td><td>Slim</td></td>');
    }
}