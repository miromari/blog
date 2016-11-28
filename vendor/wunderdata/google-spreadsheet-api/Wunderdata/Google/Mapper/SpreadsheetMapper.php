<?php

namespace Wunderdata\Google\Mapper;

use Wunderdata\Google\Spreadsheet;

class SpreadsheetMapper implements MapperInterface
{
    public function mapXmlToObject(\DOMElement $node)
    {
        $sheet = new Spreadsheet();
        $sheet->setId($node->getElementsByTagName('id')->item(0)->nodeValue);
        $sheet->setTitle($node->getElementsByTagName('title')->item(0)->nodeValue);
        $sheet->setUpdated(new \DateTime($node->getElementsByTagName('updated')->item(0)->nodeValue));

        $author = new Spreadsheet\Author();
        $author->setEmail($node->getElementsByTagName('author')->item(0)->getElementsByTagName('email')->item(0)->nodeValue);
        $author->setName($node->getElementsByTagName('author')->item(0)->getElementsByTagName('name')->item(0)->nodeValue);
        $sheet->setAuthor($author);

        $links = $node->getElementsByTagName('link');
        foreach ($links as $link) {
            /** @var \DOMElement $link */
            $rel = $link->getAttribute('rel');
            if ($rel != 'http://schemas.google.com/spreadsheets/2006#worksheetsfeed') {
                continue;
            }

            $sheet->setWorksheetsFeedUrl($link->getAttribute('href'));
        }

        return $sheet;
    }
}