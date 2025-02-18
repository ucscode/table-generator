<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

use Ucscode\UssElement\Contracts\ElementInterface;

interface RenderableInterface
{
    public function getElement(): ElementInterface;
    public function render(): string;
}
