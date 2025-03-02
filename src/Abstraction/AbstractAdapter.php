<?php

namespace Ucscode\HtmlComponent\TableGenerator\Abstraction;

use Ucscode\HtmlComponent\TableGenerator\Contracts\AdapterInterface;
use Ucscode\Paginator\Paginator;

abstract class AbstractAdapter implements AdapterInterface
{
    abstract protected function initialize(): void;

    protected Paginator $paginator;

    public function __construct(protected mixed $data, ?Paginator $paginator = null)
    {
        $this->paginator = $paginator ?? new Paginator();

        $this->initialize();
    }

    public function getPaginator(): Paginator
    {
        return $this->paginator;
    }

    protected function toTitleCase(string $value): string
    {
        $value = str_replace('_', ' ', $value);
        $value = preg_replace('/(?<!\s)([A-Z])/', ' $1', $value);

        return ucwords(trim($value));
    }
}
