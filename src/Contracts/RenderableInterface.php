<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Contracts;

use Ucscode\UssElement\Contracts\ElementInterface;

interface RenderableInterface
{
    public function render(): string;
    public function createElement(): ElementInterface;
}
