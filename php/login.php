<?php
require_once '../inc/function.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
// Initialisation
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

if (strlen($email) > 0 && strlen($password) > 0) {
    $loggedUser = Login($email, $password);

  if ($loggedUser != null || $loggedUser != false) {
    $_SESSION["loggedUser"] = $loggedUser;
    $_SESSION['loggedIn'] = true;

    echo json_encode([
      'ReturnCode' => 0,
      'Success' => "Login is correct"
    ]);
    exit();
  }

  echo json_encode([
    'ReturnCode' => 1,
    'Error' => "Username/Password invalid"
  ]);
  exit();
}
