<?php

namespace Wunderdata\Google\Tests;

use Wunderdata\Google\Client;
use Wunderdata\Google\Row;
use Wunderdata\Google\Spreadsheet;
use Wunderdata\Google\Worksheet;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadSpreadsheets()
    {
        $response = $this->getMockBuilder('Buzz\Message\Response')->disableOriginalConstructor()->getMock();
        $response->expects($this->once())->method('getContent')->will($this->returnValue($this->loadResource('spreadsheets.xml')));
        $browser = $this->getMockBuilder('Buzz\Browser')->disableOriginalConstructor()->getMock();
        $browser->expects($this->once())->method('get')->will($this->returnValue($response));

        $client = new Client('someToken', $browser);
        $spreadsheets = $client->loadSpreadsheets();

        $this->assertCount(2, $spreadsheets);
        /** @var Spreadsheet $sheet */
        $sheet = $spreadsheets[0];
        $this->assertEquals('https://spreadsheets.google.com/feeds/spreadsheets/private/full/someId1', $sheet->getId());
        $this->assertEquals('2013-09-09 15:26:15', $sheet->getUpdated()->format('Y-m-d H:i:s'));
        $this->assertEquals('https://spreadsheets.google.com/feeds/worksheets/someId1/private/full', $sheet->getWorksheetsFeedUrl());
        $this->assertEquals('mike@wunderdata.com', $sheet->getAuthor()->getEmail());
        $this->assertEquals('mike', $sheet->getAuthor()->getName());
        $this->assertEquals('Sample Spreadsheet', $sheet->getTitle());
    }

    public function testLoadWorksheetFromSpreadsheet()
    {
        $response = $this->getMockBuilder('Buzz\Message\Response')->disableOriginalConstructor()->getMock();
        $response->expects($this->once())->method('getContent')->will($this->returnValue($this->loadResource('worksheets.xml')));
        $browser = $this->getMockBuilder('Buzz\Browser')->disableOriginalConstructor()->getMock();
        $browser->expects($this->once())->method('get')->will($this->returnValue($response));

        $client = new Client('someToken', $browser);

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setWorksheetsFeedUrl('someurl');

        $worksheets = $client->loadWorksheets($spreadsheet);

        $this->assertCount(1, $worksheets);

        /** @var Worksheet $sheet */
        $sheet = $worksheets[0];
        $this->assertEquals('https://spreadsheets.google.com/feeds/worksheets/someId1/private/full/od6', $sheet->getId());
        $this->assertEquals('2013-09-09 15:26:15', $sheet->getUpdated()->format('Y-m-d H:i:s'));
        $this->assertEquals('Tabellenblatt1', $sheet->getTitle());
        $this->assertEquals('https://spreadsheets.google.com/feeds/list/someId1/od6/private/full', $sheet->getListFeedUrl());
        $this->assertEquals('https://spreadsheets.google.com/feeds/cells/someId1/od6/private/full', $sheet->getCellFeedUrl());
        $this->assertEquals('https://spreadsheets.google.com/tq?key=someId1&sheet=od6', $sheet->getVisualizationApiUrl());
        $this->assertEquals(2, $sheet->getColCount());
        $this->assertEquals(2, $sheet->getRowCount());
    }

    public function testLoadCellFeedFromWorksheet()
    {
        $response = $this->getMockBuilder('Buzz\Message\Response')->disableOriginalConstructor()->getMock();
        $response->expects($this->once())->method('getContent')->will($this->returnValue($this->loadResource('cellfeed.xml')));
        $browser = $this->getMockBuilder('Buzz\Browser')->disableOriginalConstructor()->getMock();
        $browser->expects($this->once())->method('get')->will($this->returnValue($response));

        $client = new Client('someToken', $browser);

        $worksheet = new Worksheet();
        $worksheet->setCellFeedUrl('someUrl');

        $feed = $client->loadCellFeed($worksheet);

        $this->assertCount(4, $feed->getCells());

        $a2 = $feed->findCell('A2');
        $this->assertEquals('https://spreadsheets.google.com/feeds/cells/someId1/od6/private/full/R2C1', $a2->getId());
        $this->assertEquals('A2', $a2->getTitle());
        $this->assertEquals('Cell A2', $a2->getContent());
        $this->assertEquals('2013-09-09 15:26:15', $a2->getUpdated()->format('Y-m-d H:i:s'));
    }

    public function testLoadListFeedFromWorksheet()
    {
        $response = $this->getMockBuilder('Buzz\Message\Response')->disableOriginalConstructor()->getMock();
        $response->expects($this->once())->method('getContent')->will($this->returnValue($this->loadResource('listfeed.xml')));
        $browser = $this->getMockBuilder('Buzz\Browser')->disableOriginalConstructor()->getMock();
        $browser->expects($this->once())->method('get')->will($this->returnValue($response));

        $client = new Client('someToken', $browser);

        $worksheet = new Worksheet();
        $worksheet->setCellFeedUrl('someUrl');

        $feed = $client->loadListFeed($worksheet);

        $rows = $feed->getRows();
        $this->assertCount(2, $rows);

        /** @var Row $row */
        $row = $rows[0];

        $this->assertEquals('https://spreadsheets.google.com/feeds/list/someId3/od6/private/full/cokwr', $row->getId());
        $this->assertEquals('2013-09-10 19:20:34', $row->getUpdated()->format('Y-m-d H:i:s'));
        $this->assertEquals('Mike', $row->getTitle());
        $cols = $row->getColumns();
        $this->assertEquals('Mike', $cols['name']);
        $this->assertEquals('26', $cols['age']);
        $this->assertEquals('Berlin', $cols['location']);

        $cols = $rows[1]->getColumns();
        $this->assertEquals('Tom', $cols['name']);
        $this->assertEquals('29', $cols['age']);
        $this->assertEquals('New York', $cols['location']);
    }

    private function loadResource($file)
    {
        return file_get_contents(__DIR__ . '/../Resources/' . $file);
    }
}