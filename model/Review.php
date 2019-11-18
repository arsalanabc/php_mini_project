<?php


class Review
{
    private $id;
    private $content;

    function __construct($name)
    {
        $this->content = $name;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}