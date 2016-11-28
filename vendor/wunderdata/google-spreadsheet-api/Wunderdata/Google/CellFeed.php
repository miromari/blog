<?php

namespace Wunderdata\Google;

class CellFeed
{
    /**
     * @var array
     */
    private $cells;

    /**
     * @param array $cells
     */
    function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    /**
     * @return array
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * @param string $cellName
     * @return Cell|null
     */
    public function findCell($cellName)
    {
        foreach ($this->cells as $cell) {
            if ($cell->getTitle() == $cellName) {
                return $cell;
            }
        }
        return null;
    }
}