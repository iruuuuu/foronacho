<?php

class ThreadRepository
{

    public static function getThreadById($id)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM thread WHERE id=" . $id;
        $result = $db->query($q);
        if ($row = $result->fetch_assoc()) {
            return new Thread($row['id'], $row['name'], $row['author'], $row['datetime']);
        }
        return false;
    }

    public static function getThreads()
    {
        $db = Connection::connect();
        $q = "SELECT * FROM thread";
        $result = $db->query($q);
        $threads = array();
        while ($row = $result->fetch_assoc()) {
            $threads[] = new Thread($row['id'], $row['name'], $row['author'], $row['datetime']);
        }
        return $threads;
    }
}
