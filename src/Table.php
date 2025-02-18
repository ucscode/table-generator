<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\ColGroupCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TbodyCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Caption;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\ColGroup;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Tbody;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Tfoot;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Thead;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\TableComponentInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableElementTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Enums\NodeNameEnum;
use Ucscode\UssElement\Node\ElementNode;

class Table implements TableComponentInterface
{
    use TableElementTrait;

    protected ?Caption $caption = null;
    protected ColGroupCollection $colGroupCollection;
    protected ?Thead $thead = null;
    protected TbodyCollection $tbodyCollection;
    protected ?Tfoot $tfoot = null;

    public function __construct()
    {
        $this->colGroupCollection = new ColGroupCollection();
        $this->tbodyCollection = new TbodyCollection();
        $this->buildElement();
    }

    public function setCaption(Caption $caption): static
    {
        $this->caption = $caption;

        return $this;
    }

    public function getCaption(): ?Caption
    {
        return $this->caption;
    }

    public function setColGroupCollection(ColGroupCollection $colGroupCollection): static
    {
        $this->colGroupCollection = $colGroupCollection;

        return $this;
    }

    public function getColGroupCollection(): ColGroupCollection
    {
        return $this->colGroupCollection;
    }

    public function addColGroup(ColGroup $colGroup): static
    {
        $this->colGroupCollection->add($colGroup);

        return $this;
    }

    public function getColGroup(int $index = 0): ?ColGroup
    {
        return $this->colGroupCollection->get($index);
    }

    public function hasColGroup(ColGroup $colGroup): bool
    {
        return $this->colGroupCollection->has($colGroup);
    }

    public function removeColGroup(int|ColGroup $indexOrcolGroup): static
    {
        $this->colGroupCollection->remove($indexOrcolGroup);

        return $this;
    }

    public function setThead(Thead $thead): static
    {
        $this->thead = $thead;

        return $this;
    }

    public function getThead(): ?Thead
    {
        return $this->thead;
    }

    public function setTfoot(Tfoot $tfoot): static
    {
        $this->tfoot = $tfoot;

        return $this;
    }

    public function getTfoot(): ?Tfoot
    {
        return $this->tfoot;
    }

    public function setTbodyCollection(TbodyCollection $tbodyCollection): static
    {
        $this->tbodyCollection = $tbodyCollection;

        return $this;
    }

    public function getTbodyCollection(): TbodyCollection
    {
        return $this->tbodyCollection;
    }

    public function addTbody(Tbody $tbody): static
    {
        $this->tbodyCollection->add($tbody);

        return $this;
    }

    public function getTbody(int $index = 0): ?Tbody
    {
        return $this->tbodyCollection->get($index);
    }

    public function hasTbody(Tbody $tbody): bool
    {
        return $this->tbodyCollection->has($tbody);
    }

    public function removeTbody(int|Tbody $indexOrTbody): static
    {
        $this->tbodyCollection->remove($indexOrTbody);

        return $this;
    }

    protected function buildElement(array|Attributes $attributes = []): void
    {
        $this->element = new ElementNode(NodeNameEnum::NODE_TABLE, $attributes, $attributes);
    }
}
