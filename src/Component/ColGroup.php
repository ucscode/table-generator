<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Col;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\RenderableInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableFragmentTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class ColGroup implements TableComponentInterface, RenderableInterface
{
    use TableFragmentTrait;
    use RenderableTrait;

    /**
     * @var Col[] $cols
     */
    protected array $cols = [];

    public function __construct()
    {
        $this->buildElement();
    }

    public function addCol(Col $col): static
    {
        $this->cols[] = $col;

        return $this;
    }

    public function getCol(int $index): ?Col
    {
        return $this->cols[$index] ?? null;
    }

    public function hasCol(Col $col): bool
    {
        return in_array($col, $this->cols, true);
    }

    public function removeCol(Col|int $indexOrCol): static
    {
        if ($indexOrCol instanceof Col) {
            $indexOrCol = $this->indexOf($indexOrCol);
        }

        if ($indexOrCol !== false) {
            /** @var int $indexOrCol */
            if (array_key_exists($indexOrCol, $this->cols)) {
                unset($this->cols[$indexOrCol]);
                $this->cols = array_values($this->cols);
            }
        }

        return $this;
    }

    public function indexOf(Col $col): int|bool
    {
        return array_search($col, $this->cols, true);
    }

    protected function buildElement(array|Attributes $attributes = []): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_COLGROUP, $attributes);
    }
}
