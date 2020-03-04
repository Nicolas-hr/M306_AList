<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedUser']) && !empty($_SESSION['loggedUser']) || $_SESSION['loggedIn'] == true) {
    unset($_SESSION['loggedUser']);

    $_SESSION['loggedIn'] = false;
    header('Location: ./index.php');
    exit();
}
