<?php

namespace Wunderdata\Google;

class Cell
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
     * @var content
     */
    private $content;

    /**
     * @param \Wunderdata\Google\content $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \Wunderdata\Google\content
     */
    public function getContent()
    {
        return $this->content;
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


}