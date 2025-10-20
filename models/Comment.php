<?php

class Comment
{

    private $id;
    private $content;
    private $author;
    private $datetime;
    private $visible;

    public function __construct($id, $content, $author, $datetime, $visible)
    {
        $this->id = $id;
        $this->content = $content;
        $this->author = $author;
        $this->datetime = $datetime;
        $this->visible = $visible;
    }

    public function __toString()
    {
        return $this->content;
    }

    public function getAuthor()
    {
        return UserRepository::getUserById($this->author);
    }
    public function getDatetime()
    {
        return $this->datetime;
    }
    public function getId()
    {
        return $this->id;
    }
    public function isVisible()
    {
        return $this->visible;
    }

    public function __serialize(): array
    {
        $array = [];
        $array['content'] = $this->content;
        return $array;
    }


}
