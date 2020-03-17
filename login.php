<?php
/*
*     Author              :  Hoarau Nicolas.
*     Project             :  AList.
*     Page                :  Login.php.
*     Brief               :  Login page for user.
*     Starting Date       :  05.02.2020.
*/
require_once __DIR__ . '/inc/function.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (IsLogged()) {
  header('Location: ./index.php');
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
  <title>Login</title>
</head>

<body>
  <?php include './inc/navbar.inc.php'; ?>
  <div id="loginForm">
    <div class="container">
      <div class="row justify-content-center mt-4">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <div class="row">
                    <div class="col">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col">
                      <label for="emailStagiaire">Password :</label>
                      <input type="password" class="form-control" id="password" placeholder="******" name="password" required>
                    </div>
                    <p id="error"></p>
                  </div>
                  <div class="form-group">
                    <laSbel>&nbsp;</laSbel>
                    <input type="submit" class="form-control btn btn-outline-primary" id="btnLogUser" value="Login" name="btnLogUser">
                    <a href="./register.php">Doesn't have an account? Register</a>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--    IMPORT BOOTSRAP   -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!--    IMPORT JQUERY   -->
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="./js/login.js"></script>

</body>

</html>