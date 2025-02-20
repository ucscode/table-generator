<?php

namespace Ucscode\HtmlComponent\TableGenerator\Traits;

use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;
use Ucscode\UssElement\Contracts\ElementInterface;

trait TrCollectionTrait
{
    protected TrCollection $trCollection;

    public function getTrCollection(): TrCollection
    {
        return $this->trCollection;
    }

    public function addTr(Tr $tr): static
    {
        $this->trCollection->add($tr);

        return $this;
    }

    public function getTr(int $index): ?Tr
    {
        return $this->trCollection->get($index);
    }

    public function hasTr(Tr $tr): bool
    {
        return $this->trCollection->has($tr);
    }

    public function removeTr(Tr|int $trIdentity): static
    {
        $this->trCollection->remove($trIdentity);

        return $this;
    }

    public function indexOf(Tr $tr): int|bool
    {
        return $this->trCollection->indexOf($tr);
    }

    protected function createTrOrientedElement(ElementInterface $element): ElementInterface
    {
        foreach ($this->trCollection->toArray() as $tr) {
            $element->appendChild($tr->createElement());
        }

        return $element;
    }
}
