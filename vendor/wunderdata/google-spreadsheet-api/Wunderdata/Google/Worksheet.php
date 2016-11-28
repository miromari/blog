<?php

namespace Wunderdata\Google;

class Worksheet
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $listFeedUrl;

    /**
     * @var string
     */
    private $cellFeedUrl;

    /**
     * @var string
     */
    private $visualizationApiUrl;

    /**
     * @var int
     */
    private $rowCount;

    /**
     * @var int
     */
    private $colCount;

    /**
     * @param string $cellFeedUrl
     */
    public function setCellFeedUrl($cellFeedUrl)
    {
        $this->cellFeedUrl = $cellFeedUrl;
    }

    /**
     * @return string
     */
    public function getCellFeedUrl()
    {
        return $this->cellFeedUrl;
    }

    /**
     * @param int $colCount
     */
    public function setColCount($colCount)
    {
        $this->colCount = $colCount;
    }

    /**
     * @return int
     */
    public function getColCount()
    {
        return $this->colCount;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $listFeedUrl
     */
    public function setListFeedUrl($listFeedUrl)
    {
        $this->listFeedUrl = $listFeedUrl;
    }

    /**
     * @return string
     */
    public function getListFeedUrl()
    {
        return $this->listFeedUrl;
    }

    /**
     * @param int $rowCount
     */
    public function setRowCount($rowCount)
    {
        $this->rowCount = $rowCount;
    }

    /**
     * @return int
     */
    public function getRowCount()
    {
        return $this->rowCount;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param string $visualizationApiUrl
     */
    public function setVisualizationApiUrl($visualizationApiUrl)
    {
        $this->visualizationApiUrl = $visualizationApiUrl;
    }

    /**
     * @return string
     */
    public function getVisualizationApiUrl()
    {
        return $this->visualizationApiUrl;
    }


}