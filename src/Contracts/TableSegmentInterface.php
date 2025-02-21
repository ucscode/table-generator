<?php

namespace Ucscode\HtmlComponent\TableGenerator\Contracts;

use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;

interface TableSegmentInterface extends TableComponentInterface
{
    public function getTrCollection(): TrCollection;
    public function addTr(Tr $tr): static;
    public function getTr(int $index): ?Tr;
    public function hasTr(Tr $tr): bool;
    public function removeTr(Tr|int $trIdentity): static;
    public function indexOf(Tr $tr): int|bool;
}
