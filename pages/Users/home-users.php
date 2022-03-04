<?php

  require '../../database.php';
  session_start();

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, CI, name, rol, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Usuario</title>
</head>
<body>

    <br> Welcome. <?= $user['name']; ?>
    <br>You are Successfully Logged In <?= $user['rol']; ?>
    <a href="../../logout.php">
        Logout
    </a>
</body>
</html>