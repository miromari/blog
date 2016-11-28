<?php

namespace Wunderdata\Google;

use Buzz\Browser;
use Buzz\Message\Response;
use Wunderdata\Google\Mapper\CellMapper;
use Wunderdata\Google\Mapper\RowMapper;
use Wunderdata\Google\Mapper\SpreadsheetMapper;
use Wunderdata\Google\Mapper\WorksheetMapper;

class Client
{
    /**
     * @var Browser
     */
    private $browser;

    /**
     * @var string
     */
    private $accessToken;

    function __construct($accessToken, Browser $browser)
    {
        $this->accessToken = $accessToken;
        $this->browser = $browser;
    }

    /**
     * @return array
     */
    public function loadSpreadsheets()
    {
        $response = $this->browser->get(
            'https://spreadsheets.google.com/feeds/spreadsheets/private/full',
            $this->createAuthorizationHeader()
        );
        $document = new \DOMDocument();
        $document->loadXML($response->getContent());
        $xmlList = $document->getElementsByTagName('entry');
        $mapper = new SpreadsheetMapper();
        $spreadsheets = array();
        foreach ($xmlList as $entry) {
            $spreadsheets[] = $mapper->mapXmlToObject($entry);
        }

        return $spreadsheets;
    }

    public function loadWorksheets(Spreadsheet $spreadsheet)
    {
        $headers = $this->createAuthorizationHeader();

        $response = $this->browser->get($spreadsheet->getWorksheetsFeedUrl(), $headers);
        $document = new \DOMDocument();
        $document->loadXML($response->getContent());
        $xmlList = $document->getElementsByTagName('entry');
        $mapper = new WorksheetMapper();
        $worksheets = array();
        foreach ($xmlList as $entry) {
            $worksheets[] = $mapper->mapXmlToObject($entry);
        }
        return $worksheets;
    }

    public function loadCellFeed(Worksheet $worksheet)
    {
        $response = $this->browser->get($worksheet->getCellFeedUrl(), $this->createAuthorizationHeader());
        $nodes = $this->getEntryNodes($response);
        $mapper = new CellMapper();
        $cells = array();
        foreach ($nodes as $node) {
            $cells[] = $mapper->mapXmlToObject($node);
        }
        return new CellFeed($cells);
    }

    public function loadListFeed(Worksheet $worksheet)
    {
        $response = $this->browser->get($worksheet->getListFeedUrl(), $this->createAuthorizationHeader());
        $nodes = $this->getEntryNodes($response);
        $mapper = new RowMapper();
        $rows = array();
        foreach ($nodes as $node) {
            $rows[] = $mapper->mapXmlToObject($node);
        }
        return new ListFeed($rows);
    }

    private function getEntryNodes(Response $response)
    {
        $document = new \DOMDocument();
        $document->loadXML($response->getContent());
        return $document->getElementsByTagName('entry');
    }

    private function createAuthorizationHeader()
    {
        return array(
            'Authorization: Bearer ' . $this->accessToken
        );
    }
}