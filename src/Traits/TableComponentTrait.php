<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Traits;

use Ucscode\HtmlComponent\HtmlTableGenerator\Support\ParameterBag;

trait TableComponentTrait
{
    private ?ParameterBag $parameters = null;

    public function getParameters(): ParameterBag
    {
        if ($this->parameters === null) {
            $this->parameters = new ParameterBag();
        }

        return $this->parameters;
    }
}
