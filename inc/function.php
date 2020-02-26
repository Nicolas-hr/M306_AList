<?php
/*
*     Author              :  Fujise Thomas, Hoarau Nicolas.
*     Project             :  AList.
*     Page                :  Function.php.
*     Brief               :  Function page for the web application.
*     Starting Date       :  05.02.2020.
*/

require_once __DIR__.'/dbConnect.php';
require_once __DIR__.'/tMailer.php';
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ LOGIN FUNCTIONS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

/**
 * @author Hoarau Nicolas
 * 
 * @brief function for user login in database
 *
 * @param string $mail
 * @param string $password
 * 
 * @return array || null
 */
function Login($mail, $password) {
  $query = <<<EOT
  SELECT idUser, email, username
  FROM t_user
  WHERE email = :email 
  AND password = :userPwd
  EOT;

  $password = sha1($mail . $password);

  try {
    $requestLogin = EDatabase::getDb()->prepare($query);
    $requestLogin->bindParam(':email', $mail, PDO::PARAM_STR);
    $requestLogin->bindParam(':userPwd', $password, PDO::PARAM_STR);
    $requestLogin->execute();

    $result = $requestLogin->fetch(PDO::FETCH_ASSOC);

    return count($result) > 0 ? $result : null;
  } catch (PDOException $e) {
    $e->getMessage('Error while login', $e::getMessage());

    return null;
  }
}

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ REGISTER FUNCTIONS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
/**
 * @author Thomas Fujise
 * 
 * @brief function for user registration in database
 *
 * @param string $nickname
 * @param string $mail
 * @param string $pwd
 */
function registerUser($nickname, $email, $pwd, $logo = "logo.png", $activated = 0, $role = 1)
{
    //$sql = "INSERT INTO t_user(NICKNAME, EMAIL, ACTIVATION, STATE, PASSWORD,ROLE, EMAIL_TOKEN) VALUES(:nickname,:email,:activation,:state,:password,:role,:emailToken)";
    $sql = <<<EX
        INSERT INTO t_user(username, password, email, logo, email_token, activated, idRole) VALUES(:username, :password, :email, :logo, :emailToken, :activated, :role)
    EX;
    $req = EDatabase::getDb()->prepare($sql);
    $token = sha1($email . microtime());
    $req->bindParam(':username', $nickname, \PDO::PARAM_STR);
    $req->bindParam(':password', $pwd, \PDO::PARAM_STR);
    $req->bindParam(':email',$email, \PDO::PARAM_STR);
    $req->bindParam(':logo', $logo, \PDO::PARAM_STR);
    $req->bindParam(':emailToken', $token, \PDO::PARAM_STR);
    $req->bindParam(':activated', $activated, \PDO::PARAM_INT);
    $req->bindParam(':role', $role, \PDO::PARAM_INT);
    $req->execute();
    //$send = TMailer::sendMail(array($email),$nickname, $token);
}

/**
 * @author Thomas Fujise
 * 
 * @brief function for email token verification
 *
 * @param string $token user's token for activation
 * @return int id user else false
 */
function verifyToken($token){
    $sql = "SELECT idUser FROM t_user WHERE email_token = :token";
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
 * @author Thomas Fujise
 * 
 * @brief function for account activation
 *
 * @param integer $id user id
 */
function activateAccount($id){
    $sql = "UPDATE t_user SET ACTIVATED = 1 WHERE idUser = :idUser";
    $req = EDatabase::getDb()->prepare($sql);
    $req->bindParam('idUser', $id[0], \PDO::PARAM_INT);
    $req->execute();
}

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ PROFILE FUNCTIONS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
/**
 * @author Nicolas Hoarau
 * 
 * @brief function for getting user data
 *
 * @param integer $userId user id
 * @return array || null
 */
function GetUserData(int $userId) {
  $query = <<<EX
  SELECT u.username, u.logo, l.note, l.dateWatched, a.name
  FROM t_user AS u
  JOIN t_library as l ON u.idUser = l.idUser
  JOIN t_anime as a ON l.idAnime = a.idAnime
  WHERE u.idUser = :idUser 
  EX;

  try {
    $requestUserData= EDatabase::getDb()->prepare($query);
    $requestUserData->bindParam(':userPwd', $userId, PDO::PARAM_INT);
    $requestUserData->execute();

    $userData = $requestUserData->fetch(PDO::FETCH_ASSOC);

    return count($userData) > 0 ? $userData : null;
  } catch (PDOException $e) {
    $e->getMessage('Error while login', $e::getMessage());

    return null;
  }
}
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ HOME DISPLAY FUNCTIONS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function GetAllAnime() {
  $sql = <<<EX
  SELECT idAnime, name, avgNote, addDate, cover, description 
  FROM t_anime
  EX;
  try{
    $req = EDatabase::getDb()->prepare($sql);
    $req->execute();
    $animes = $req->fetchAll(PDO::FETCH_ASSOC);
    return count($animes) > 0 ? $animes : null;
  }
  catch (PDOException $e) {
    $e->getMessage('Error while login', $e->getMessage());
    return null;
  }
  $message .= "<div class='row'>";
  foreach ($animes as $key => $anime){
          //$message
  }
}