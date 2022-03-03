<?php
    require 'database.php';
    $message = '';

  if (!empty($_POST['CI']) && !empty($_POST['name']) && !empty($_POST['rol']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (CI, name, rol, password) VALUES (:CI, :name, :rol, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CI', $_POST['CI']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':rol', $_POST['rol']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
    
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>
    
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="CI" type="text" placeholder="Enter your CI">
      <input name="name" type="text" placeholder="Enter your name">
      <input name="rol" type="text" placeholder="Enter your rol">
      <input name="password" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>

  </body>
</html>