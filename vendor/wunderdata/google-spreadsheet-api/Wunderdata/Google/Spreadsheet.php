<?php

namespace Wunderdata\Google;

use Wunderdata\Google\Spreadsheet\Author;

class Spreadsheet
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
    private $worksheetsFeedUrl;

    /**
     * @var Author
     */
    private $author;

    /**
     * @param \Wunderdata\Google\Spreadsheet\Author $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return \Wunderdata\Google\Spreadsheet\Author
     */
    public function getAuthor()
    {
        return $this->author;
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
     * @param string $worksheetsFeedLink
     */
    public function setWorksheetsFeedUrl($worksheetsFeedLink)
    {
        $this->worksheetsFeedUrl = $worksheetsFeedLink;
    }

    /**
     * @return string
     */
    public function getWorksheetsFeedUrl()
    {
        return $this->worksheetsFeedUrl;
    }
}