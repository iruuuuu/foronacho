<?php

class Thread
{
    private $id;
    private $name;
    private $author;
    private $datetime;
    private $comments = array();

    public function __construct($id, $name, $author, $datetime)
    {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
        $this->datetime = $datetime;
        $this->comments = CommentRepository::getCommentsByThreadId($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAuthor()
    {
        return UserRepository::getUserById($this->author);
    }

    public function getDatetime()
    {
        return $this->datetime;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
