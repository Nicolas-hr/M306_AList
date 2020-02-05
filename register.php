<?php
/*
*     Author              :  Fujise Thomas.
*     Project             :  AList.
*     Page                :  Register.php.
*     Brief               :  Register page for user.
*     Starting Date       :  05.02.2020.
*/

require_once $_SERVER['DOCUMENT_ROOT'].'/M306_Alist/inc/dbConnect.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/M306_Alist/inc/function.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$register = filter_input(INPUT_POST,"btnRegister");

if ($register)
{
    $nicknameUser = filter_input(INPUT_POST,"nicknameUser", FILTER_SANITIZE_STRING);
    $emailUser = filter_input(INPUT_POST,"emailUser", FILTER_VALIDATE_EMAIL);
    $pwdUser = filter_input(INPUT_POST,"password", FILTER_SANITIZE_STRING);
    $pwdUser2 = filter_input(INPUT_POST,"password2", FILTER_SANITIZE_STRING);
    $error = [];

     // Check if nickname is empty.
     if (!$nicknameUser)
     {
         $error["nickname"] = "Nickname incomplet";
     }
 
     // Check if email field is an email and is not empty
     if (!$emailUser)
     {
         $error["email"] = "Email incomplet";
     }
 
     // Check if password is not empty
     if (!$pwdUser)
     {
         $error["password"] = "Missing password";
     }
 
     // Check if confirm password is not empty
     if (!$pwdUser2)
     {
         $error["password"] = "Missing password";
     } 
 
 
     // Check if account already exist with this email
    /* if (verifyEmail($emailUser))
     {
         $error["email"] = "Mail already use";
     }*/
     //Check if both password are the same
     if ($pwdUser != $pwdUser2)
     {
         $error["password"] = "Both password are not the same";
     }
     
     // Check if there is no error in the form if so send data to the db.
     if (count($error) == 0)
     {
         $pwdUser = sha1($emailUser.$pwdUser);
         registerUser($nicknameUser,$emailUser,$pwdUser);
         $_SESSION["register"] = true;
         header("Location: connection.php");
     }

}
?>
<!DOCTYPE html>
<html lang="FR" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <title>Home</title>
</head>
<body>
<?php
    include "./form/registerForm.php";
?>

</body>
</html>

<script src="./script/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
