<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/M306_Alist/inc/dbConnect.php';

/**
 * Login
 *
 * @param string $mail
 * @param string $password
 * @return array || null
 */
function LoginWith($mail, $password)
{
  $query = <<<EX
  SELECT idUser, email, username, 
  FROM t_user
  WHERE `{$mail}` = :username 
  AND `{$password}` = :userPwd
  EX;

  $password = sha1($password . $mail);

  try {
    $requestLogin = EDatabase::prepare($query);
    $requestLogin->bindParam(':wayToConnectValue', $mail, PDO::PARAM_STR);
    $requestLogin->bindParam(':userPwd', $password, PDO::PARAM_STR);
    $requestLogin->execute();

    $result = $requestLogin->fetch(PDO::FETCH_ASSOC);

    return $result !== false > 0 ? $result : null;
  } catch (PDOException $e) {
    $e->getMessage('Error while login', $e::getMessage());

    return null;
  }
}
