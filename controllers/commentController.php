<?php

if (isset($_GET['delete'])) {
    CommentRepository::deleteComment($_GET['delete']);
    header('location:index.php?c=thread&id=' . $_GET['threadId']);
}

if (isset($_POST['content'])) {
    CommentRepository::addComment($_POST['content'], $_POST['threadId']);

    header('location:index.php?c=thread&id=' . $_POST['threadId']);
}
