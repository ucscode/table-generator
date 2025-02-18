<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Traits;

trait DataTrait
{
    protected mixed $data = null;

    public function getData(): mixed
    {
        return $this->data;
    }

    public function setData(mixed $data): static
    {
        $this->data = $data;

        return $this;
    }
}
