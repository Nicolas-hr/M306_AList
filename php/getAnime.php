<?php
require_once '../inc/dbConnect.php';

$userId = filter_var($_POST['idUser'], FILTER_SANITIZE_NUMBER_INT);

$data = array();

$query = <<<EOT
SELECT a.name, a.avgNote, a.cover, a.description, l.note
FROM t_anime AS a
JOIN t_library AS l ON a.idAnime = l.idAnime
JOIN t_user AS u ON u.idUser = l.idUser 
WHERE a.idAnime = idAnime AND u.idUser = :idUser
EOT;

try {
  $requestGetAnime = EDatabase::prepare($query);
  $requestGetAnime->bindParam(':idAnime', $idAnime, PDO::PARAM_INT);
  $requestGetAnime->bindParam(':idUser', $idUser, PDO::PARAM_INT);
  $requestGetAnime->execute();

  $result = $requestGetAnime->fetch(PDO::FETCH_ASSOC);

  echo json_encode($result);
} catch (PDOException $e) {
  $e->getMessage();
}