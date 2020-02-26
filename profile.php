<?php
/*
*     Author              :  Hoarau Nicolas.
*     Project             :  AList.
*     Page                :  profile.php.
*     Brief               :  User page.
*     Starting Date       :  19.02.2020.
*/

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>Profil</title>
</head>

<body>
  <?php include './inc/navbar.inc.html'; ?>
  <br>
  <div id="profil"></div>

  <!--    IMPORT BOOTSRAP   -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

  <!--    IMPORT JQUERY   -->
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="./js/profile.js"></script>
  <script>
        $(document).ready(() => {
          let url_string = document.URL;
          let url = new URL(url_string);
          let idUser = url.searchParams.get("idUser");
          
          let idUserSess = <?= $_SESSION['loggedUser']['idUser'] ?>;
    
          GetUserData(idUser == null ? idUserSess : idUser);
        });
  </script>

</body>

</html>