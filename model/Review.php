<?php


class Review
{
    private $id;
    private $content;
    private $timestamp;

    function __construct($content, $timestamp=null)
    {
        $this->content = $content;
        $this->timestamp = $timestamp;
    }

    public function get_content()
    {
        return $this->content;
    }

    public function get_timestamp()
    {
        return $this->timestamp;
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