<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\AdapterInterface;
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
}
