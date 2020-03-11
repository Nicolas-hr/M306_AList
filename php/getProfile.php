<?php
require_once '../inc/dbConnect.php';

$idUser = filter_var($_POST['idUser'], FILTER_SANITIZE_NUMBER_INT);

$query = <<<EOT
SELECT u.username, u.email, u.logo
FROM t_user AS u
WHERE u.idUser = :idUser
EOT;

$query2 = <<<EOT
SELECT l.note, l.dateWatched, a.name, a.avgNote, a.addDate, a.cover, a.description
FROM t_user AS u
JOIN t_library AS l ON u.idUser = l.idUser
JOIN t_anime AS a ON a.idAnime = l.idAnime
WHERE u.idUser = :idUser
EOT;

try {
  $requestGetUser = EDatabase::getDb()->prepare($query);
  $requestGetUser->bindParam(':idUser', $idUser, PDO::PARAM_INT);
  $requestGetUser->execute();

  $data['userData'] = $requestGetUser->fetch(PDO::FETCH_ASSOC);

  $requestGetLibrary = EDatabase::getDb()->prepare($query2);
  $requestGetLibrary->bindParam(':idUser', $idUser, PDO::PARAM_INT);
  $requestGetLibrary->execute();

  $data['libraryData'] = $requestGetLibrary->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode(count($data['userData']) > 0 ? $data : null);
} catch (Exception $e) {
  $e->getMessage('Error while login', $e::getMessage());

  return null;
}