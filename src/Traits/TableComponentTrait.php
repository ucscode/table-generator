<?php

namespace Ucscode\HtmlComponent\TableGenerator\Traits;

use Ucscode\HtmlComponent\TableGenerator\Support\Meta;

trait TableComponentTrait
{
    protected ?Meta $meta = null;

    public function getMeta(): Meta
    {
        return $this->meta ??= new Meta();
    }
}
