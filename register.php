<?php
/*
*     Author              :  Fujise Thomas.
*     Project             :  AList.
*     Page                :  Register.php.
*     Brief               :  Register page for user.
*     Starting Date       :  05.02.2020.
*/

require_once __DIR__ . '/inc/dbConnect.php';
require_once __DIR__ . '/inc/function.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (IsLogged()) {
    header('Location: ./index.php');
}

$register = filter_input(INPUT_POST, "registerUser");

if ($register) {
    $nicknameUser = filter_input(INPUT_POST, "nicknameUser", FILTER_SANITIZE_STRING);
    $emailUser = filter_input(INPUT_POST, "emailUser", FILTER_VALIDATE_EMAIL);
    $pwdUser = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $pwdUser2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_STRING);
    $error = [];

    // Check if nickname is empty.
    if (!$nicknameUser) {
        $error["nickname"] = "Nickname incomplet";
        echo "NNN";
    }

    if (strlen($nicknameUser) > 20)
        $error['nickname'] = "Nickname too long";

    // Check if email field is an email and is not empty
    if (!$emailUser) {
        $error["email"] = "Email incomplet";
        echo "EEE";
    }

    if (MailAlreadyUsed($emailUser))
        $error["email"] = "Email already used";

    // Check if password is not empty
    if (!$pwdUser) {
        $error["password"] = "Missing password";
        echo "PWDD";
    }

    // Check if confirm password is not empty
    if (!$pwdUser2) {
        $error["password"] = "Missing password";
        echo "PWDDD";
    }


    // Check if account already exist with this email
    /* if (verifyEmail($emailUser))
     {
         $error["email"] = "Mail already use";
     }*/
    //Check if both password are the same
    if ($pwdUser != $pwdUser2) {
        $error["password"] = "Both password are not the same";
        echo "PWD";
    }

    // Check if there is no error in the form if so send data to the db.
    if (count($error) == 0) {
        $pwdUser = sha1($emailUser . $pwdUser);
        registerUser($nicknameUser, $emailUser, $pwdUser);
        $_SESSION["register"] = true;
        header("Location: login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="FR" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <title>Home</title>
</head>

<body>
    <?php
    include './inc/navbar.inc.php';
    include "./form/registerForm.php";
    ?>

</body>

</html>

<!--    IMPORT BOOTSRAP   -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="./script/script.js"></script>