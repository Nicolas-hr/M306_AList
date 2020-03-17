<?php
require_once dirname(__DIR__) . '/inc/function.php';

$idAnime = filter_var($_POST['idAnime'], FILTER_SANITIZE_NUMBER_INT);
$allScoreAnime = GetAllScoreAnime($idAnime);
$avg = 0;

for ($i=0; $i < count($allScoreAnime); $i++) { 
  $avg += $allScoreAnime[$i]['note'];
}

$avg = $avg / count($allScoreAnime);

if (UpdateAnimeAvgNote($idAnime, intval($avg))) {
  echo json_encode([
    'ReturnCode' => 0,
    'Success' => "Score updated correctly"
  ]);
  exit();
}