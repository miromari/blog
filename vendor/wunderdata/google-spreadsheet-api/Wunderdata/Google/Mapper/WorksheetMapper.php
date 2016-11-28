<?php

namespace Wunderdata\Google\Mapper;

use Wunderdata\Google\Worksheet;

class WorksheetMapper implements MapperInterface
{
    public function mapXmlToObject(\DOMElement $node)
    {
        $sheet = new Worksheet();
        $sheet->setId($node->getElementsByTagName('id')->item(0)->nodeValue);
        $sheet->setTitle($node->getElementsByTagName('title')->item(0)->nodeValue);
        $sheet->setUpdated(new \DateTime($node->getElementsByTagName('updated')->item(0)->nodeValue));

        $sheet->setRowCount((int)$node->getElementsByTagNameNS('http://schemas.google.com/spreadsheets/2006', 'rowCount')->item(0)->nodeValue);
        $sheet->setColCount((int)$node->getElementsByTagNameNS('http://schemas.google.com/spreadsheets/2006', 'colCount')->item(0)->nodeValue);

        $links = $node->getElementsByTagName('link');
        foreach ($links as $link) {
            /** @var \DOMElement $link */
            $rel = $link->getAttribute('rel');

            switch ($rel) {
                case 'http://schemas.google.com/spreadsheets/2006#listfeed':
                    $sheet->setListFeedUrl($link->getAttribute('href'));
                    break;
                case 'http://schemas.google.com/spreadsheets/2006#cellsfeed':
                    $sheet->setCellFeedUrl($link->getAttribute('href'));
                    break;
                case 'http://schemas.google.com/visualization/2008#visualizationApi':
                    $sheet->setVisualizationApiUrl($link->getAttribute('href'));
                    break;
            }
        }

        return $sheet;
    }
}