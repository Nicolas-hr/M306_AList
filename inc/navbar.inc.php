<?php require_once __DIR__ . '/function.php' ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="./index.php">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if(!IsLogged()){ ?>
      <li class="nav-item">
        <a class="nav-link" href="./login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./register.php">Register</a>
      </li>
      <?php } else { ?>
        <li class="nav-item">
        <a class="nav-link" href="./profile.php">Profile</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="./logout.php">Déconexion</a>
      </li>
      <?php } ?>
    </ul>
  </div>
</nav>