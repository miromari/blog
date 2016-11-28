<?php

namespace Wunderdata\Google\Tests;

use Wunderdata\Google\Cell;
use Wunderdata\Google\CellFeed;

class CellFeedTest extends \PHPUnit_Framework_TestCase
{
    public function testFindCellWithValidCellName()
    {
        $cell1 = new Cell();
        $cell1->setTitle('A1');
        $cell1->setContent('Cell A1');

        $cell2 = new Cell();
        $cell2->setTitle('A2');
        $cell2->setContent('Cell A2');

        $cell3 = new Cell();
        $cell3->setTitle('B1');
        $cell3->setContent('Cell B1');

        $cells = array(
            $cell1, $cell2, $cell3
        );

        $feed = new CellFeed($cells);

        $cell = $feed->findCell('A2');

        $this->assertEquals('Cell A2', $cell->getContent());
        $this->assertEquals('A2', $cell->getTitle());
    }
}