<?php
class Page
{
    protected $id = null;
    protected $creatorId = null;
    protected $title = null;
    protected $content = null;
    protected $dateUpdate = null;
    protected $dateAdded = null;

    function getId()
    {
        return $this->id;
    }

    function getCreatorId()
    {
        return $this->creatorId;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getContent()
    {
        return $this->content;
    }

    function getDateUpdated()
    {
        return $this->dateUpdate;
    }

    function getDateAdded()
    {
        return $this->dateAdded;
    }

    function getIntro($count = 200) 
    {
        return substr(strip_tags($this->content), 0, $count) . '...';
    }
}
