<?php

if (isset($_GET['id'])) {
    $thread = ThreadRepository::getThreadById($_GET['id']);
    require_once('views/showThread.phtml');
    exit();
}
