<?php
  session_start();

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
<!doctype html>
                        <html>
                            <head>
                                <meta charset='utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1'>
                                <title>Menu Administrador</title>
                              </head>
  <body oncontextmenu='return false' class='snippet-body'>
  <div class="wrapper">
  <?php require '../../partials/navbar-admin.php' ?>
  <div class="content container-fluid">
  <?php require '../../partials/navbar-top.php' ?>
        <div class="content-wrapper">
            <h2>Collapsible Sidebar Using Bootstrap 4</h2>
            <div class="line"></div>
        </div>
    </div>
  </div>
  
  
                                </body>
                            </html>