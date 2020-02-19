<?php
require_once '../inc/function.php';

// Initialisation
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

if (strlen($email) > 0 && strlen($password) > 0) {
    $loggedUser = Login($email, $password);

  if ($loggedUser !== null) {
    $_SESSION["loggedUser"] = $loggedUser;
    $_SESSION['loggedIn'] = true;

    echo json_encode([
      'ReturnCode' => 0,
      'Success' => "Login is correct"
    ]);
    exit();
  }

  echo json_encode([
    'ReturnCode' => 2,
    'Error' => "Username/Password invalid"
  ]);
}
