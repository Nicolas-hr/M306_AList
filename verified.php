<?php
require_once __DIR__.'/inc/function.php';
$token = $_GET['token'];
if(verifyToken($token) != false){
    activateAccount(verifyToken($token));
    echo "Your account is activate !";
}
else{
    echo "Wrong link :/";
}
?>