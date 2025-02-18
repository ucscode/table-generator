<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\ElementInterface;

interface RenderableInterface extends \Stringable
{
    public function setAttributes(Attributes $attributes): static;
    public function getAttributes(): Attributes;
    public function createElement(): ElementInterface;
    public function render(?int $indent): string;
}
