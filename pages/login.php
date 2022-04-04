<?php
  require '../database/database.php';
  if (!empty($_POST['CI']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id_u, CI, name, rol, password, state FROM users WHERE CI = :CI');
    $records->bindParam(':CI', $_POST['CI']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';
    if ($results != []) {
      if($results['state']==1){
        if (password_verify($_POST['password'], $results['password'])){
          $_SESSION['user_id'] = $results['id_u'];
          if($results['rol'] == 1){
              header("Location: Admin/home-admin.php");      
          } else if ($results['rol'] == 2) {
              header("Location: Users/home-users.php");
          }
      }else {
          $message = 'Lo sentimos, contraseña incorrecta';
      }
  } else {
    $message = 'Lo sentimos, Usuario blockeado, hable con administracion para habilitar su cuenta';
  } 

      } else {
        $message = 'Lo sentimos, Usuario con encontrado';
      }
  } 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://kit.fontawesome.com/22abe1b6b1.js" crossorigin="anonymous"></script>
  </head>
  <body>
  <div class="loginBox">
    <img class="user" src="../assets/img/logo.jpg" height="100px" width="100px">
      <h3>Iniciar Sesión</h3>
      <form action="login.php" method="POST" autocomplete="off">
          <div class="inputBox"> 
            <input name="CI" type="text" placeholder="Numero de CI">
            <input name="password" type="password" placeholder="Contraseña">
            <?php if(!empty($message)): ?>
              <p>
                <?= $message ?>
            </p>
              <?php endif; ?>
            <input type="submit" value="¡Entrar!">
          </div>
          <a href="/Formularios"><i class="fa-solid fa-angles-left"></i> Atras</a>
      </form>
  </div>
  </body>
</html>