<?php
require_once __DIR__ . '/inc/function.php';
require_once __DIR__ . '/inc/frontend.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$idAnime = isset($_GET['idAnime']) ? $_GET['idAnime'] : 1;
$idUser = isset($_SESSION['loggedUser']['idUser']) ? $_SESSION['loggedUser']['idUser'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/style.css">
  <title></title>
</head>

<body>
  <?php include './inc/navbar.inc.php'; ?>
  <div id="anime">
    <?php isset($_SESSION['loggedUser']['idUser']) ? ShowAnimeLogged(GetAnimeData($idAnime, $idUser)) : ShowAnimeNotLogged(GetAnimeData($idAnime)); ?>
  </div>

  <!--    IMPORT BOOTSRAP   -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!--    IMPORT JQUERY   -->
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</body>

</html>