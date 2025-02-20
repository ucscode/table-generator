<?php

namespace Ucscode\HtmlComponent\TableGenerator\Traits\Constructor;

use Ucscode\UssElement\Collection\Attributes;

trait DataConstructorTrait
{
    public function __construct(mixed $data = null, array|Attributes $attributes = [])
    {
        $this->data = $data;
        $this->attributes = $attributes instanceof Attributes ? $attributes : new Attributes($attributes);
    }
}
