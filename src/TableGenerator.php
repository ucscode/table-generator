<?php

namespace Ucscode\HtmlComponent\TableGenerator;

use Ucscode\HtmlComponent\TableGenerator\Collection\MiddlewareCollection;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\TableGenerator\Component\Tbody;
use Ucscode\HtmlComponent\TableGenerator\Component\Tfoot;
use Ucscode\HtmlComponent\TableGenerator\Component\Thead;
use Ucscode\HtmlComponent\TableGenerator\Contracts\AdapterInterface;
use Ucscode\HtmlComponent\TableGenerator\Contracts\MiddlewareInterface;
use Ucscode\Paginator\Paginator;
use Ucscode\UssElement\Collection\Attributes;

class TableGenerator implements \Stringable
{
    public const POSITION_INDEX = ':position';
    public const SECTION_THEAD = 1;
    public const SECTION_TBODY = 2;
    public const SECTION_TFOOT = 3;

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
        $this->middlewareCollection->add($middleware);

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

        $this->table = new Table($attributes);

        $tr = $this->processMiddleware($this->adapter->getTheadTr(), self::SECTION_THEAD);
        $thead = (new Thead())->addTr($tr);

        if ($tr->getCellCollection()->count()) {
            $this->table->setThead($thead);
        }

        $tbody = new Tbody();

        foreach ($this->adapter->getTbodyTrCollection() as $tr) {
            $tr = $this->processMiddleware($tr, self::SECTION_TBODY);
            $tbody->addTr($tr);
        }

        if ($tbody->getTrCollection()->count()) {
            $this->table->addTbody($tbody);
        }

        if ($this->tfootEnabled) {
            $tr = $this->processMiddleware($this->adapter->getTheadTr(), self::SECTION_TFOOT);
            $tfoot = (new Tfoot())->addTr($tr);

            if ($tr->getCellCollection()->count()) {
                $this->table->setTfoot($tfoot);
            }
        }

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

    protected function processMiddleware(Tr $tr, int $section): Tr
    {
        foreach ($this->middlewareCollection as $middleware) {
            $tr->getParameters()->set(self::POSITION_INDEX, $section);
            $tr = $middleware->alterTr($tr);
        }

        return $tr;
    }
}
