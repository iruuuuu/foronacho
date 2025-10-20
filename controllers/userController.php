<?php

require_once 'helpers/fileHelper.php';
require_once 'models/UserRepository.php';

//accion registro

if (isset($_POST['password2']) && isset($_POST['password']) && isset($_POST['username'])) {
    $db = Connection::connect();

    if ($_POST['password'] == $_POST['password2']) {
        $q = "insert into users (username, password) values ('" . $_POST['username'] . "',md5('" . $_POST['password'] . "'));";
        $db->query($q);
        require_once 'views/loginView.phtml';
        die();
    }
}

//accion login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simulación de verificación de usuario
    $db = Connection::connect();
    $q = "SELECT * FROM users WHERE username = '$username' AND password = md5('$password')";
    $result = $db->query($q);
    if ($row = $result->fetch_assoc()) {
        $user = new User($row['id'], $row['username'], '', $row['roles']);
        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
        } else
            require_once('views/loginView.php');
    }
}

if (isset($_GET['register'])) {
    require_once('views/registerView.phtml');
    die();
}

if (isset($_POST['register'])) {
    $newUserId = UserRepository::register($_POST['u'], $_POST['pw']);
    require_once 'views/editUserView.phtml';
    die();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
}

if (isset($_GET['edit'])) {
    require_once 'views/editUserView.phtml';
    die();
}

if (isset($_GET['setAvatar'])) {
    if (isset($_FILES['avatar'])) {

        if (FileHelper::fileHandler($_FILES['avatar']['tmp_name'], 'public/img/' . $_FILES['avatar']['name'])) {

            $_SESSION['user']->setAvatar($_FILES['avatar']['name']);
        }
        header('Location: index.php?c=user&edit=1');
    }
}
