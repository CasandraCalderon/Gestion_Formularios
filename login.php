<?php
  if (isset($_SESSION['user_id']) && $roles == 0) {
    header('Location: pages/Admin/home-admin.php');
  } else if (isset($_SESSION['user_id']) && $roles == 1){
    header('Location:  pages/Users/home-users.php');
  }
  require 'database.php';
  if (!empty($_POST['CI']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, CI, name, rol, password FROM users WHERE CI = :CI');
    $records->bindParam(':CI', $_POST['CI']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';
    $roles = '';


    if ($results != []) {
        if (password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['id'];
            if($results['rol'] == 'Administrador'){
                $roles = 0;
                header("Location: pages/Admin/home-admin.php");
            } else if ($results['rol'] == 'Usuario') {
                $roles = 1;
                header("Location: pages/Users/home-users.php");
            }
        } else {
            $message = 'Sorry, incorrect password';
        }
    } else {
        $message = 'Sorry, User not found';
    }
      
  }
  

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
  <div class="loginBox">
    <img class="user" src="assets/img/logo.jpg" height="100px" width="100px">
      <h3>Login</h3>
      <form action="login.php" method="POST">
          <div class="inputBox"> 
            <input name="CI" type="text" placeholder="Enter your CI">
            <input name="password" type="password" placeholder="Enter your Password">
            <?php if(!empty($message)): ?>
              <p>
                <?= $message ?>
            </p>
              <?php endif; ?>
            <input type="submit" value="Get in!">
          </div>
          <?php require 'partials/header.php' ?>
      </form>
  </div>
  </body>
</html>