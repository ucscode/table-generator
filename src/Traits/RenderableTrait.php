<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Traits;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\RenderableInterface;
use Ucscode\UssElement\Collection\Attributes;
use Ucscode\UssElement\Contracts\ElementInterface;
use Ucscode\UssElement\Contracts\NodeInterface;
use Ucscode\UssElement\Node\TextNode;

trait RenderableTrait
{
    protected Attributes $attributes;

    public function __toString(): string
    {
        return $this->render();
    }

    public function render(?int $indent = null): string
    {
        return $this->createElement()->render($indent);
    }

    public function getAttributes(): Attributes
    {
        return $this->attributes;
    }

    public function setAttributes(Attributes $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
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
