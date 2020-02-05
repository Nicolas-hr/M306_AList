<?php
/*
*     Author              :  Hoarau Nicolas.
*     Project             :  AList.
*     Page                :  Login.php.
*     Brief               :  Login page for user.
*     Starting Date       :  05.02.2020.
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
  <title>Login</title>
</head>

<body>
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
                      <label for="nickname">Nickname or Mail:</label>
                      <?php if (isset($erreur["nickname"])) : ?>
                        <input type="text" class="form-control is-invalid" id="nicknameUser" placeholder="Error nickname" name="nicknameUser" required>
                        <div class="invalid-feedback">Please enter a valid nickname</div>
                      <?php else : ?>
                        <input type="text" class="form-control" id="nickname" placeholder="Nickname" name="nicknameUser" required value="<?= isset($nicknameUser) ? $nicknameUser : ""?>">
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col">
                      <label for="emailStagiaire">Password :</label>
                      <?php if (isset($erreur["password"])) : ?>
                        <input type="password" class="form-control is-invalid" id="password" placeholder="******" name="password" required>
                        <div class="invalid-feedback"><?= $erreur["password"] ?></div>
                      <?php else : ?>
                        <input type="password" class="form-control" id="password" placeholder="******" name="password" required>
                      <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                  <label for="">&nbsp;</label>
                  <input type="submit" class="form-control btn btn-outline-primary" id="registerUser" placeholder="Inscription" value="Register" name="btnAddUser">
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

  <!--    IMPORT JQUERY   -->
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="./js/login.js"></script>

</body>

</html>