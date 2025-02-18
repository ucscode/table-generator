<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test\Component;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Caption;
use Ucscode\UssElement\Collection\ClassList;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class CaptionTest extends TestCase
{
    public function testCaptionPlainRender(): void
    {
        $caption = new Caption();

        $this->assertSame($caption->render(), '<caption></caption>');
    }

    public function testCaptionWithDataRender(): void
    {
        $caption = new Caption('Caption Data');

        $this->assertSame($caption->render(), '<caption>Caption Data</caption>');
    }

    public function testCaptionWithElementAndAttributesRender(): void
    {
        $span = new ElementNode(NodeNameEnum::NODE_SPAN, [
            'id' => 'span',
        ]);

        $span->setInnerHtml('Content');

        $caption = new Caption($span, [
            'data-name' => "value-1",
            'class' => new ClassList(['class-1', 'class-2'])
        ]);

        $this->assertSame($caption->render(), '<caption data-name="value-1" class="class-1 class-2"><span id="span"><p>Content</p></span></caption>');
    }
}
