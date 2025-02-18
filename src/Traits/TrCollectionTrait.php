<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Traits;

use Ucscode\HtmlComponent\HtmlTableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Section\Tr;

trait TrCollectionTrait
{
    protected TrCollection $trCollection;

    public function __construct()
    {
        $this->trCollection = new TrCollection();
    }

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
}
