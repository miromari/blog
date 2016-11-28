<?php

namespace Wunderdata\Google\Mapper;

use Wunderdata\Google\Cell;

class CellMapper implements MapperInterface
{
    public function mapXmlToObject(\DOMElement $node)
    {
        $cell = new Cell();
        $cell->setId($node->getElementsByTagName('id')->item(0)->nodeValue);
        $cell->setTitle($node->getElementsByTagName('title')->item(0)->nodeValue);
        $cell->setContent($node->getElementsByTagName('content')->item(0)->nodeValue);
        $cell->setUpdated(new \DateTime($node->getElementsByTagName('updated')->item(0)->nodeValue));

        return $cell;
    }
}