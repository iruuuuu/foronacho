<?php
require_once('models/User.php');
require_once('models/UserRepository.php');
require_once('models/Thread.php');
require_once('models/ThreadRepository.php');
require_once('models/Comment.php');
require_once('models/CommentRepository.php');


session_start();

if (isset($_GET['c'])) {
    require_once('controllers/' . $_GET['c'] . 'Controller.php');
}

if (!isset($_SESSION['user'])) {
    require_once 'views/loginView.phtml';
    die();
}

//si ha iniciado sesión

// cargar las threads del usuario
$threads = ThreadRepository::getThreads();
// cargar la vista
require_once 'views/mainView.phtml';
