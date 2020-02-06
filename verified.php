<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/M306_Alist/inc/function.php';
$token = $_GET['token'];
if(verifyToken($token) != false){
    activateAccount(verifyToken($token));
    echo "Your account is activate !";
}
else{
    echo "Wrong link :/";
}
?>