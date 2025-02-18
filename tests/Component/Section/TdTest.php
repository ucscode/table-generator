<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test\Component\Section;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Td;
use Ucscode\UssElement\Collection\Attributes;
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
        $td = new Td(new Td('Content'));

        $this->assertSame($td->render(), '<td><td>Content</td></td>');
    }

    public function testTdWithArrayInConstructorRender(): void
    {
        $td = new Td('Content', [
            'data-attr' => 'value-1',
        ]);
        
        $this->assertSame($td->render(), '<td data-attr="value-1">Content</td>');
    }

    public function testTdWithAttributesInConstructorRender(): void
    {
        $td = new Td('Content', new Attributes([
            'data-attr' => 'value-1',
        ]));
        
        $this->assertSame($td->render(), '<td data-attr="value-1">Content</td>');
    }

    public function testTdWithAttributesOverrideRender(): void
    {
        $td = new Td('Content', new Attributes([
            'daTa-AtTr' => 'value-1',
            'devEloPer' => 'Unknown'
        ]));

        $td->getAttributes()
            ->set('developer', 'ucscode')
            ->set('extra', 'amazing')
        ;

        $this->assertSame($td->render(), '<td data-attr="value-1" developer="ucscode" extra="amazing">Content</td>');
    }
}