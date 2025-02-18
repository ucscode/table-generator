<?php

namespace Ucscode\HtmlComponent\HtmlTableGenerator\Component;

use Ucscode\HtmlComponent\HtmlTableGenerator\Contracts\GridContainerInterface;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\CollectionTrait;
use Ucscode\HtmlComponent\HtmlTableGenerator\Traits\TrTrait;

class Thead implements GridContainerInterface
{
    use CollectionTrait;
    use TrTrait;
}