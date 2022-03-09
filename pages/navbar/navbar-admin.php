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
    }
  }
?>
<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<link rel="stylesheet" href="../../css/home-admin.css">
<header>
    <nav id="sidebar">
        <div>
        <img class="user" src="../../assets/img/sanMartin.png" height="100px" width="250px">
        </div>
        <ul class="list-unstyled components">
            <p>MENUS</p>
            <hr>
            <li> <a href="../../pages/Admin/home-admin.php">Home</a> </li>
            <li> <a href="../../pages/Admin/users.php">Users</a> </li>
            <li> <a href="../../pages/Admin/area.php">Areas</a> </li>
            <li> <a href="../../pages/Admin/forms.php">Forms</a> </li>
        </ul>
        <ul class="list-unstyled" style="margin-top: 150px">
            <p><a href="../logout.php" class="btn btn-warning text-light mb-2"><i class="fa-solid fa-door-open"></i></a> Logout</p>
        </ul>
    </nav>
</header>
