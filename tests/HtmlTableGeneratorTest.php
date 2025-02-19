<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Test;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\HtmlTableGenerator\Adapter\CsvArrayAdapter;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\MiddlewareInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\HtmlTableGenerator;
use Ucscode\UssElement\Collection\Attributes;

class HtmlTableGeneratorTest extends TestCase
{
    public function testHtmlTableOutput(): void
    {
        $htmlTableGenerator = new HtmlTableGenerator(new CsvArrayAdapter([]));

        $this->assertSame($htmlTableGenerator->render(), '<table></table>');
    }

    public function testHtmlTableTheadOutput(): void
    {
        $htmlTableGenerator = new HtmlTableGenerator(new CsvArrayAdapter([
            ['id', 'name']
        ]));

        $this->assertSame($htmlTableGenerator->render(), '<table><thead><tr><th>id</th><th>name</th></tr></thead></table>');
    }

    public function testHtmlTableTheadTbodyOutput(): void
    {
        $htmlTableGenerator = new HtmlTableGenerator(new CsvArrayAdapter([
            ['id'],
            [2, 'extra']
        ]));

        $this->assertSame($htmlTableGenerator->render(), '<table><thead><tr><th>id</th></tr></thead><tbody><tr><td>2</td><td>extra</td></tr></tbody></table>');
    }

    public function testHtmlTableTheadTfootOutput(): void
    {
        $htmlTableGenerator = new HtmlTableGenerator(new CsvArrayAdapter([
            ['id'],
        ]));

        $htmlTableGenerator->setTfootEnabled(true)->regenerate();

        $this->assertSame($htmlTableGenerator->render(), '<table><thead><tr><th>id</th></tr></thead><tfoot><tr><th>id</th></tr></tfoot></table>');
    }

    public function testHtmlTableMiddleware(): void
    {
        $htmlTableGenerator = new HtmlTableGenerator(
            new CsvArrayAdapter([
                ['id'],
            ]),
            new class implements MiddlewareInterface {
                public function alterTr(Tr $tr): Tr
                {
                    $positionIndex = $tr->getParameters()->get(HtmlTableGenerator::POSITION_INDEX);

                    if ($positionIndex === HtmlTableGenerator::SECTION_TFOOT) {
                        $tr->getCell(0)->setData('transform');
                        $tr->addCell(new Th('action'));
                    }

                    return $tr;
                }
            },
            new Attributes([
                'class' => 'block-buster',
            ])
        );

        $htmlTableGenerator->setTfootEnabled(true)->regenerate();

        $this->assertSame($htmlTableGenerator->render(), '<table class="block-buster"><thead><tr><th>id</th></tr></thead><tfoot><tr><th>transform</th><th>action</th></tr></tfoot></table>');
    }
}