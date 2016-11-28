<?php

namespace Wunderdata\Google\Mapper;

use Wunderdata\Google\Row;

class RowMapper implements MapperInterface
{
    public function mapXmlToObject(\DOMElement $node)
    {
        $row = new Row();
        $row->setId($node->getElementsByTagName('id')->item(0)->nodeValue);
        $row->setTitle($node->getElementsByTagName('title')->item(0)->nodeValue);
        $row->setUpdated(new \DateTime($node->getElementsByTagName('updated')->item(0)->nodeValue));

        $gsx = $node->getElementsByTagNameNS('http://schemas.google.com/spreadsheets/2006/extended', '*');

        $entries = array();
        /** @var \DOMElement $entry */
        foreach ($gsx as $entry) {
            $name = mb_substr($entry->nodeName, 4);
            $entries[$name] = $entry->nodeValue;
        }

        $row->setColumns($entries);

        return $row;
    }
}