<?php

  session_start();

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
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="CI" type="text" placeholder="Enter your CI">
      <input name="password" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>