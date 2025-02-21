<?php

namespace Ucscode\HtmlComponent\TableGenerator\Test;

use PHPUnit\Framework\TestCase;
use Ucscode\HtmlComponent\TableGenerator\Abstraction\AbstractMiddleware;
use Ucscode\HtmlComponent\TableGenerator\Adapter\CsvArrayAdapter;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Td;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Th;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\TableGenerator\Component\Tfoot;
use Ucscode\HtmlComponent\TableGenerator\Contracts\TableSegmentInterface;
use Ucscode\HtmlComponent\TableGenerator\Table;
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
            new class () extends AbstractMiddleware {
                public function process(Table $table): Table
                {
                    $this->iterateTrsIn($table, function(Tr $tr, TableSegmentInterface $segment) {
                        if ($segment instanceof Tfoot) {
                            $tr->getCell(0)->setData('transform');
                            $tr->addCell(new Th('action'));
                        }
                    });

                    return $table;
                }
            },
            new Attributes([
                'class' => 'block-buster',
            ])
        );

        $htmlTableGenerator->setTfootEnabled(true)->regenerate();

        $this->assertSame($htmlTableGenerator->render(), '<table class="block-buster"><thead><tr><th>id</th></tr></thead><tfoot><tr><th>transform</th><th>action</th></tr></tfoot></table>');
    }

    public function testHtmlTableWithMultipleMiddlewares(): void
    {
        $adapter = new CsvArrayAdapter([
            ['id', 'username'],
            [1, 'johndoe'],
            [3, 'sammy'],
        ]);

        $checkboxMiddleware = new class () extends AbstractMiddleware {
            public function process(Table $table): Table
            {
                $this->iterateTrsIn($table, function(Tr $tr) {
                    $tr->getCellCollection()->prepend(new Td('[x]'));
                });

                return $table;
            }
        };

        $inlinerMiddleware = new class () extends AbstractMiddleware {
            public function process(Table $table): Table
            {
                $this->iterateTrsIn($table, function(Tr $tr) {
                    $tr->getCellCollection()->insertAt(2, new Td('inline'));
                });

                return $table;
            }
        };

        $actionMiddleware = new class () extends AbstractMiddleware {
            public function process(Table $table): Table
            {
                $this->iterateTrsIn($table, function(Tr $tr) {
                    $tr->getCellCollection()->append(new Td('action'));
                });

                return $table;
            }
        };

        $tableGenerator = new TableGenerator($adapter, [
            $checkboxMiddleware,
            $inlinerMiddleware,
        ]);

        $tableGenerator->addMiddleware($actionMiddleware);

        $middlewareCollection = $tableGenerator->getMiddlewareCollection();

        $this->assertCount(3, $middlewareCollection);
        $this->assertSame($middlewareCollection->get(1), $inlinerMiddleware);
        $this->assertSame($middlewareCollection->last(), $actionMiddleware);

        $theadTr = '<tr><td>[x]</td><th>id</th><td>inline</td><th>username</th><td>action</td></tr>';
        $tbodyTr = '<tr><td>[x]</td><td>1</td><td>inline</td><td>johndoe</td><td>action</td></tr>';
        $tbodyTr2 = '<tr><td>[x]</td><td>3</td><td>inline</td><td>sammy</td><td>action</td></tr>';

        $formation = sprintf('<table><thead>%s</thead><tbody>%s%s</tbody></table>', $theadTr, $tbodyTr, $tbodyTr2);

        $this->assertNotSame($formation, $tableGenerator->render());

        $tableGenerator->regenerate(); //

        $this->assertSame($formation, $tableGenerator->render());
    }
}
