<?php

namespace Wunderdata\Google;

class ListFeed
{
    /**
     * @var array
     */
    private $rows;

    /**
     * @param array $rows
     */
    function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }
}