<?php

namespace Ucscode\HtmlComponent\TableGenerator\Traits;

use Ucscode\HtmlComponent\TableGenerator\Contracts\RenderableInterface;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Contracts\NodeInterface;
use Ucscode\UssElement\Node\TextNode;

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

    protected function createDataOrientedElement(ElementInterface $element, mixed $data): ElementInterface
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
