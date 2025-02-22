<?php

namespace Ucscode\HtmlComponent\TableGenerator\Adapter;

class SampleAdapter extends AssocArrayAdapter
{
    protected string $source;

    protected function initialize(): void
    {
        $this->source = $this->data;

        // Decode the JSON file to an associative array
        $jsonData = file_get_contents(dirname(__DIR__) . '/' . $this->source);
        $dataArray = json_decode($jsonData, true);

        if (!is_array($dataArray)) {
            throw new \RuntimeException("Invalid JSON data.");
        }

        $this->data = $dataArray;
        
        parent::initialize();
    }
}
