<?php
  require '../../database.php';
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
<?php include("partials/header.php") ?>
<div class="content-wrapper">
  <h2>Welcome <?= $user['name'];?></h2>
    <div class="line"></div>
  </div>
<?php include("partials/footer.php") ?>