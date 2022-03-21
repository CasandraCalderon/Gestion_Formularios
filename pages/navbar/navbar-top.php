<?php
  require '../../database/database.php';
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, CI, name, rol, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
      $_SESSION['id_user'] = $user['id'];
    }
  }
?>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light"> <button type="button" id="sidebarCollapse" class="btn btn-success"> <i class="fa fa-align-justify"></i> </button> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
            <p><?= $user['name'];?> <a href="../logout.php" class="btn btn-warning text-light mb-2"><i class="fa-solid fa-right-to-bracket"></i></a></p>
                </ul>
            </div>
        </nav>
</header>