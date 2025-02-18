<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Abstraction;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\CellInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\RenderableInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TableComponentTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\DataTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\RenderableTrait;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Contracts\NodeInterface;
use Ucscode\UssElement\Node\TextNode;

abstract class AbstractCell implements CellInterface
{
    use TableComponentTrait;
    use RenderableTrait;
    use DataTrait;

    public function __construct(mixed $data = null, array|Attributes $attributes = [])
    {
        $this->data = $data;
        $this->attributes = $attributes instanceof Attributes ? $attributes : new Attributes($attributes);
    }

    protected function renderLogic(ElementInterface $element, mixed $data): ElementInterface
    {
        if ($data instanceof NodeInterface) {
            $element->appendChild($data);
            return $element;
        }

        if ($data instanceof RenderableInterface) {
            $element->appendChild($data->createElement());
            return $element;
        }

        if (is_scalar($this->data) || $this->data instanceof \Stringable) {
            $element->appendChild(new TextNode($data));
            return $element;
        }

        return $element;
    }
}
