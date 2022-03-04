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
<?php include("../../database.php") ?>
<?php include("partials/header.php") ?>
<div class="content-wrapper">
  <h2>Pagina Principal</h2>
    <div class="line"></div>
  </div>
<?php include("partials/footer.php") ?>