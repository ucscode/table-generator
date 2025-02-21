<?php

namespace Ucscode\HtmlComponent\TableGenerator\Traits\Constructor;

use Ucscode\HtmlComponent\TableGenerator\Collection\TrCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;
use Ucscode\UssElement\Collection\Attributes;

trait TableSectionConstructorTrait
{
    /**
     * @param null|Tr[]|TrCollection $collection
     * @param array<string,string>|Attributes $attributes
     */
    public function __construct(null|array|TrCollection $collection = null, array|Attributes $attributes = [])
    {
        $collection ??= [];
        $this->trCollection = $collection instanceof TrCollection ? $collection : new TrCollection($collection);
        $this->attributes = $attributes instanceof Attributes ? $attributes : new Attributes($attributes);
    }
}
