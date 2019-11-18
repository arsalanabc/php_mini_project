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

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }
}