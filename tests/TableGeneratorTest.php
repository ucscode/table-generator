<?php

namespace Ucscode\HtmlComponent\TableGenerator\Test;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\TableGenerator\Adapter\CsvArrayAdapter;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\TableGenerator\Contracts\MiddlewareInterface;
use Ucscode\HtmlComponent\TableGenerator\TableGenerator;
use Ucscode\UssElement\Collection\Attributes;

class TableGeneratorTest extends TestCase
{
    public function testHtmlTableOutput(): void
    {
        $htmlTableGenerator = new TableGenerator(new CsvArrayAdapter([]));

        $this->assertSame($htmlTableGenerator->render(), '<table></table>');
    }

    public function testHtmlTableTheadOutput(): void
    {
        $htmlTableGenerator = new TableGenerator(new CsvArrayAdapter([
            ['id', 'name']
        ]));

        $this->assertSame($htmlTableGenerator->render(), '<table><thead><tr><th>id</th><th>name</th></tr></thead></table>');
    }

    public function testHtmlTableTheadTbodyOutput(): void
    {
        $htmlTableGenerator = new TableGenerator(new CsvArrayAdapter([
            ['id'],
            [2, 'extra']
        ]));

        $this->assertSame($htmlTableGenerator->render(), '<table><thead><tr><th>id</th></tr></thead><tbody><tr><td>2</td><td>extra</td></tr></tbody></table>');
    }

    public function testHtmlTableTheadTfootOutput(): void
    {
        $htmlTableGenerator = new TableGenerator(new CsvArrayAdapter([
            ['id'],
        ]));

        $htmlTableGenerator->setTfootEnabled(true)->regenerate();

        $this->assertSame($htmlTableGenerator->render(), '<table><thead><tr><th>id</th></tr></thead><tfoot><tr><th>id</th></tr></tfoot></table>');
    }

    public function testHtmlTableMiddleware(): void
    {
        $htmlTableGenerator = new TableGenerator(
            new CsvArrayAdapter([
                ['id'],
            ]),
            new class () implements MiddlewareInterface {
                public function alterTr(Tr $tr): Tr
                {
                    $positionIndex = $tr->getParameters()->get(TableGenerator::POSITION_INDEX);

                    if ($positionIndex === TableGenerator::SECTION_TFOOT) {
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
