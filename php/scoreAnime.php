<?php
require_once '../inc/dbConnect.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$score = filter_var($_POST['score'], FILTER_SANITIZE_NUMBER_INT);
$userId = $_SESSION['loggedUser']['idUser'];

$query = <<<EOT
UPDATE t_library SET note = :note WHERE idUser = :idUser AND idAnime = :idAnime;
EOT;

try {
  EDatabase::beginTransaction();

  $updateAnimeScore = EDatabase::getDb()->prepare($query);
  $requestGetUser->bindParam(':idUser', $idUser, PDO::PARAM_INT);
  $requestGetUser->bindParam(':idAnime', $idAnime, PDO::PARAM_INT);
  $requestGetUser->execute();

  EDatabase::commit();
  echo json_encode([
    'ReturnCode' => 0,
    'Success' => "Score updated correctly"
  ]);
  exit();
} catch (Exception $e) {
  EDatabase::rollBack();
  throw $e->getMessage();
}
