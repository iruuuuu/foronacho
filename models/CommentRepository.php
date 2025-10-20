<?php

class CommentRepository
{

    public static function getCommentsByThreadId($id)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM comment where visible=1 AND threadId=" . $id;
        $result = $db->query($q);
        $comments = array();
        while ($row = $result->fetch_assoc()) {
            $comments[] = new Comment($row['id'], $row['content'], $row['author'], $row['datetime'], $row['visible']);
        }
        return $comments;
    }

    public static function addComment($content, $threadId)
    {
        $db = Connection::connect();
        $q = "INSERT INTO comment VALUES(NULL, '" . $content . "', " . $_SESSION['user']->getId() . ", NOW(), " . $threadId . ", 1)";

        $result = $db->query($q);
        return $db->insert_id;
    }

    public static function deleteComment($id)
    {
        $db = Connection::connect();
        // $q = "DELETE FROM comment WHERE id=" . $id;
        $q = "UPDATE comment SET visible=0 WHERE id=" . $id;
        $result = $db->query($q);
        return $db->affected_rows;
    }
}
