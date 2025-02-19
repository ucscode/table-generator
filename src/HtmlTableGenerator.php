<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator;

use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Tbody;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Tfoot;
use Ucscode\HtmlComponent\HtmlTableGenerator\Component\Thead;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\AdapterInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\MiddlewareInterface;
use Ucscode\Paginator\Paginator;
use Ucscode\UssElement\Collection\Attributes;

class HtmlTableGenerator implements \Stringable
{
    public const POSITION_INDEX = ':position';
    public const SECTION_THEAD = 1;
    public const SECTION_TBODY = 2;
    public const SECTION_TFOOT = 3;

    protected ?Table $table = null;
    protected bool $tfootEnabled = false;

    public function __construct(
        protected AdapterInterface $adapter,
        protected ?MiddlewareInterface $middleware = null,
        null|array|Attributes $attributes = null
    ) {
        $this->regenerate($attributes);
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function getTable(): Table
    {
        return $this->table;
    }

    public function render(): string
    {
        return $this->table->render();
    }

    public function getPaginator(): Paginator
    {
        return $this->adapter->getPaginator();
    }

    public function setTfootEnabled(bool $enabled): static
    {
        $this->tfootEnabled = $enabled;

        return $this;
    }

    public function isTfootEnabled(): bool
    {
        return $this->tfootEnabled;
    }

    public function setAdapter(AdapterInterface $adapter): static
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function getAdapter(): AdapterInterface
    {
        return $this->adapter;
    }

    public function setMiddleware(?MiddlewareInterface $middleware): static
    {
        $this->middleware = $middleware;

        return $this;
    }

    public function getMiddleware(): ?MiddlewareInterface
    {
        return $this->middleware;
    }

    final public function regenerate(null|array|Attributes $attributes = null): static
    {
        if ($attributes === null) {
            $attributes = $this->table?->getAttributes() ?? new Attributes();
        }

        $this->table = new Table($attributes);

        $tr = $this->adapter->getTheadTr();
        $tr->getParameters()->set(self::POSITION_INDEX, self::SECTION_THEAD);

        if ($this->middleware) {
            $tr = $this->middleware->alterTr($tr);
        }

        if ($tr->getCellCollection()->count()) {
            $thead = (new Thead())->addTr($tr);
            $this->table->setThead($thead);
        }

        $tbody = new Tbody();

        foreach ($this->adapter->getTbodyTrCollection()->toArray() as $tr) {
            $tr->getParameters()->set(self::POSITION_INDEX, self::SECTION_TBODY);

            if ($this->middleware) {
                $tr = $this->middleware->alterTr($tr);
            }

            $tbody->addTr($tr);
        }

        if ($tbody->getTrCollection()->count()) {
            $this->table->addTbody($tbody);
        }

        if ($this->tfootEnabled) {
            $tr = $this->adapter->getTheadTr();
            $tr->getParameters()->set(self::POSITION_INDEX, self::SECTION_TFOOT);

            if ($this->middleware) {
                $tr = $this->middleware->alterTr($tr);
            }

            if ($tr->getCellCollection()->count()) {
                $tfoot = (new Tfoot())->addTr($tr);
                $this->table->setTfoot($tfoot);
            }
        }

        return $this;
    }
}
