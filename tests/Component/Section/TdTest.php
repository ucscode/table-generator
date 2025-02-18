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
    }

    public function testTdHtmlStringRender(): void
    {
        $td = new Td('<p>James Blunt</p>');
    }

    public function testTdNodeInterfaceRender(): void
    {
        $node = new ElementNode(NodeNameEnum::NODE_DIV, [
            'id' => 'example'
        ]);

        $node->appendChild(new TextNode('Working Logic'));
        
        $td = new Td($node);
    }

    public function testTdInnerTableRender(): void
    {
        $table = new Table();

        $td = new Td($table);
    }
}