<?php
/*
*     Author              :  Fujise Thomas, Hoarau Nicolas.
*     Project             :  AList.
*     Page                :  Function.php.
*     Brief               :  Function page for the web application.
*     Starting Date       :  05.02.2020.
*/
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/dbConnect.php';
//require_once __DIR__ . '/tMailer.php';

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ LOGGED FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
/**
 * @author Hoarau Nicolas
 * 
 * Check if the user is logged
 * 
 * @return bool
 */
function IsLogged()
{
  $isLogged = false;

  if (array_key_exists('loggedIn', $_SESSION)) {
    if ($_SESSION['loggedIn'] == true) {
      $isLogged = true;
    }
  }

  return  $isLogged;
}

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
function Login($mail, $password)
{
  $query = "
  SELECT idUser, email, username
  FROM t_user
  WHERE email = :email 
  AND password = :userPwd
  ";

  $password = sha1($mail . $password);

  try {
    $requestLogin = EDatabase::getDb()->prepare($query);
    $requestLogin->bindParam(':email', $mail, PDO::PARAM_STR);
    $requestLogin->bindParam(':userPwd', $password, PDO::PARAM_STR);
    $requestLogin->execute();

    $result = $requestLogin->fetch(PDO::FETCH_ASSOC);

    return $result != false ? $result : null;
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
  $sql = "
        INSERT INTO t_user(username, password, email, logo, email_token, activated, idRole) VALUES(:username, :password, :email, :logo, :emailToken, :activated, :role)
    ";
  $req = EDatabase::getDb()->prepare($sql);
  $token = sha1($email . microtime());
  $req->bindParam(':username', $nickname, \PDO::PARAM_STR);
  $req->bindParam(':password', $pwd, \PDO::PARAM_STR);
  $req->bindParam(':email', $email, \PDO::PARAM_STR);
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
function verifyToken($token)
{
  $sql = "SELECT idUser FROM t_user WHERE email_token = :token";
  $req = EDatabase::getDb()->prepare($sql);
  $req->bindParam(':token', $token, \PDO::PARAM_STR);
  $req->execute();

  if ($req->rowCount() == 1) {
    $idUser = $req->fetch();
    return $idUser;
  } else {
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
function activateAccount($id)
{
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
function GetUserData(int $userId)
{
  $query = "
  SELECT u.username, u.logo, l.note, l.dateWatched, a.name
  FROM t_user AS u
  JOIN t_library as l ON u.idUser = l.idUser
  JOIN t_anime as a ON l.idAnime = a.idAnime
  WHERE u.idUser = :idUser 
  ";

  try {
    $requestUserData = EDatabase::getDb()->prepare($query);
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
/**
 * @author Thomas Fujise
 * 
 * @brief function for get all anime in the database
 *
 * @return string html to display in index page
 */
function ShowAllAnime() {
  $sql = <<<EX
  SELECT idAnime, name, avgNote, addDate, cover, description 
  FROM t_anime
  EX;
  try {
    $req = EDatabase::getDb()->prepare($sql);
    $req->execute();
    $animes = $req->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $e) {
    $e->getMessage('Error while login', $e->getMessage());
    return null;
  }
  $message = <<<EOT
  <div class="row mx-auto" style="width: 80%;" >
  EOT;
  for($i = 0; $i<count($animes);$i++){
    $cover = GetCoverAnime($animes[$i]['idAnime']);
    $message .= <<<EOT
    <div class="col-md-4">
    <h2>{$animes[$i]['name']}</h2>
    <p><img src="data:image/bmp;base64,{$cover}"/></p><p>{$animes[$i]['description']}</p>
    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
    </div>
    EOT;
    if(($i+1)%3==0){
      $message .= <<<EOT
      </div>
      <div class="row mx-auto" style="width: 80%;">
      EOT;
    }
  }
  $message .= <<<EOT
  </div>
  EOT;
  return $message;
}
/**
 * @author Thomas Fujise
 * 
 * @brief function to get Cover from the anime
 *
 * @param int id anime
 * @return string html to display in index page
 */
function GetCoverAnime($idAnime){
  $sql = <<<EOT
  SELECT cover FROM t_anime WHERE idAnime = :idAnime
  EOT;
  try{
  $req = EDatabase::getDB()->prepare($sql);
  $req->bindParam(':idAnime', $idAnime, PDO::PARAM_INT);
  $req->execute();
  $result = $req->fetchAll();
  return  base64_encode($result[0]['cover']);
}catch(PDOException $e){
  $e->getMessage('Error while login', $e->getMessage());
  return null;
}
}
