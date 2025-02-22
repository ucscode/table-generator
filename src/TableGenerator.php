<?php

namespace Ucscode\HtmlComponent\TableGenerator;

use Ucscode\HtmlComponent\TableGenerator\Collection\MiddlewareCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Tbody;
use Ucscode\HtmlComponent\TableGenerator\Component\Tfoot;
use Ucscode\HtmlComponent\TableGenerator\Component\Thead;
use Ucscode\HtmlComponent\TableGenerator\Contracts\AdapterInterface;
use Ucscode\HtmlComponent\TableGenerator\Contracts\MiddlewareInterface;
use Ucscode\Paginator\Paginator;
use Ucscode\UssElement\Collection\Attributes;

class TableGenerator implements \Stringable
{
    protected ?Table $table = null;
    protected bool $tfootEnabled = false;
    protected MiddlewareCollection $middlewareCollection;

    public function __construct(
        protected AdapterInterface $adapter,
        null|MiddlewareInterface|array|MiddlewareCollection $middleware = null,
        null|array|Attributes $attributes = null
    ) {
        $this->initializeMiddleware($middleware);
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

    public function render(?int $indent = null): string
    {
        return $this->getTable()->render($indent);
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

    public function setMiddlewareCollection(MiddlewareCollection $middlewareCollection): static
    {
        $this->middlewareCollection = $middlewareCollection;

        return $this;
    }

    public function getMiddlewareCollection(): MiddlewareCollection
    {
        return $this->middlewareCollection;
    }

    public function addMiddleware(MiddlewareInterface $middleware): static
    {
        $this->middlewareCollection->append($middleware);

        return $this;
    }

    public function removeMiddleware(MiddlewareInterface $middleware): static
    {
        $this->middlewareCollection->remove($middleware);

        return $this;
    }

    public function hasMiddleware(MiddlewareInterface $middleware): bool
    {
        return $this->middlewareCollection->has($middleware);
    }

    public function getMiddleware(int $index): ?MiddlewareInterface
    {
        return $this->middlewareCollection->get($index);
    }

    final public function regenerate(null|array|Attributes $attributes = null): static
    {
        // use existing table attributes
        $attributes ??= ($this->table?->getAttributes() ?? new Attributes());

        $table = new Table($attributes);

        if ($thead = $this->generateThead()) {
            $table->setThead($thead);
        }

        if ($tbody = $this->generateTbody()) {
            $table->addTbody($tbody);
        }

        if ($tfoot = $this->generateTfoot()) {
            $table->setTfoot($tfoot);
        }

        foreach ($this->middlewareCollection as $middleware) {
            $table = $middleware->process($table);
        }

        $this->table = $table;

        return $this;
    }

    protected function initializeMiddleware(null|MiddlewareInterface|array|MiddlewareCollection $middleware = null): void
    {
        if ($middleware === null) {
            $middleware = new MiddlewareCollection();
        }

        if (is_array($middleware)) {
            $middleware = new MiddlewareCollection($middleware);
        }

        if ($middleware instanceof MiddlewareInterface) {
            $middleware = new MiddlewareCollection([
                $middleware,
            ]);
        }

        $this->middlewareCollection = $middleware;
    }

    private function generateThead(): ?Thead
    {
        $tr = $this->adapter->getTheadTr();

        return !$tr->getCellCollection()->isEmpty() ? new Thead([$tr]) : null;
    }

    private function generateTbody(): ?Tbody
    {
        $trCollection = $this->adapter->getTbodyTrCollection();

        if ($trCollection->isEmpty()) {
            return null;
        }

        $tbody = new Tbody();

        foreach ($trCollection as $tr) {
            if (!$tr->getCellCollection()->isEmpty()) {
                $tbody->addTr($tr);
            }
        }

        return $tbody->getTrCollection()->isEmpty() ? null : $tbody;
    }

    private function generateTfoot(): ?Tfoot
    {
        if ($this->isTfootEnabled()) {
            $tr = $this->adapter->getTheadTr();

            if (!$tr->getCellCollection()->isEmpty()) {
                return new Tfoot([$tr]);
            }
        }

        return null;
    }
}
