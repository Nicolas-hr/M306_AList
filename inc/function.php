<?php
/*
*     Author              :  Fujise Thomas.
*     Project             :  AList.
*     Page                :  Function.php.
*     Brief               :  Function page for the web application.
*     Starting Date       :  05.02.2020.
*/

require_once $_SERVER['DOCUMENT_ROOT'].'/M306_Alist/inc/dbConnect.php';

/**
 * function for user registration in database
 *
 * @param [string] $nickname
 * @param [string] $email
 * @param [string] $pwd
 * @return void
 */
function registerUser($nickname, $email, $pwd, $activation = 0,$state = 0, $role = 1)
{
    //$sql = "INSERT INTO t_user(NICKNAME, EMAIL, ACTIVATION, STATE, PASSWORD,ROLE, EMAIL_TOKEN) VALUES(:nickname,:email,:activation,:state,:password,:role,:emailToken)";
    $sql = <<<EX
        INSERT INTO t_user(NICKNAME, EMAIL, ACTIVATION, STATE, PASSWORD,ROLE, EMAIL_TOKEN)
        VALUES(:nickname,:email,:activation,:state,:password,:role,:emailToken)
    EX;
    $req = EDatabase::getDb()->prepare($sql);
    $token = sha1($email . microtime());
    $req->bindParam(':nickname', $nickname, \PDO::PARAM_STR);
    $req->bindParam(':email',$email, \PDO::PARAM_STR);
    $req->bindParam(':password', $pwd, \PDO::PARAM_STR);
    $req->bindParam(':activation', $activation, \PDO::PARAM_INT);
    $req->bindParam(':state', $state , \PDO::PARAM_INT);
    $req->bindParam(':role', $role, \PDO::PARAM_INT);
    $req->bindParam(':emailToken', $token, \PDO::PARAM_STR);    
    $req->execute();
    $send = TMailer::sendMail(array($email),$nickname, $token);
}
/**
 * Function for email token verification
 * @return int id user else false
 */
function verifyToken($token){
    $sql = "SELECT id FROM t_user WHERE email_token = :token";
    $req = EDatabase::getDb()->prepare($sql);
    $req->bindParam(':token', $token, \PDO::PARAM_STR);
    $req->execute();

    if($req->rowCount() == 1){
        $idUser = $req->fetch();
        return $idUser;
    }
    else{
        return false;
    }
}
/**
 * Function for account activation
 */
function activateAccount($id){
    $sql = "UPDATE t_user SET ACTIVATED = 1 WHERE id = :idUser";
    $req = EDatabase::getDb()->prepare($sql);
    $req->bindParam('idUser', $id[0], \PDO::PARAM_INT);
    $req->execute();
}
?>