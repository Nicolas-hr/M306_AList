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

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/style.css">
  <title>Profil</title>
</head>

<body>
  <?php include './inc/navbar.inc.php'; ?>
  <br>
  <div id="profil"></div>

  <!--    IMPORT BOOTSRAP   -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!--    IMPORT JQUERY   -->
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="./js/profile.js"></script>
  <script>
    $(document).ready(() => {
      let idUser;
      let url_string = document.URL;
      let url = new URL(url_string);
      let idUserParam = url.searchParams.get("idUser");
      let idUserSess = <?= $_SESSION['loggedUser']['idUser'] ?>;

      if (idUserParam != null) {
        idUser = idUserParam;
      } else if (idUserSess != null) {
        idUser = idUserSess
      } else {
        idUser = null;
      }

      GetUserData(idUser);
    });
  </script>

</body>

</html>