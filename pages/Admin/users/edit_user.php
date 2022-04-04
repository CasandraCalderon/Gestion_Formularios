<?php
    require '../../../database/bd.php';
    session_start();
    if (isset($_SESSION['id_user']) && $_SESSION['rol']==1){
        if(isset($_GET['id_u'])){
          $id_u = $_GET['id_u'];
          $query = "SELECT * FROM users WHERE id_u = $id_u";
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) == 1){
              $row = mysqli_fetch_array($result);
              $ci = $row['CI'];
              $name = $row['name'];
              $rol = $row['rol'];
              $password = $row['password'];
          }
      }
      if (isset($_POST['Update'])) {
          $id_u = $_GET['id_u'];
          $ci = $_POST['CI'];
          $name = $_POST['name'];
          $rol = $_POST['rol'];
          $query = "UPDATE users set CI = '$ci', name = '$name', rol = '$rol' WHERE id_u = $id_u";
          $result = mysqli_query($conn, $query);
          if(!$result){
              die("Failed");
          }
          $_SESSION['message'] = 'Usuario Actualizado Exitosamente';
          $_SESSION['message_type'] = 'warning';
          header("location: ../users.php"); 

      }
    }
    else {
      header("Location: ../../logout.php");  
    }
    
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edit User</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/login.css">
    <script src="https://kit.fontawesome.com/22abe1b6b1.js" crossorigin="anonymous"></script>
  </head>
  <body>
  <div class="loginBox">
    <img class="user" src="../../../assets/img/logo.jpg" height="100px" width="100px">
      <h3>Editar Usuario</h3>
      <form action="edit_user.php?id_u=<?php echo $_GET['id_u'];?>" method="POST" autocomplete="off">
          <div class="inputBox"> 
            <input name="CI" type="text" value="<?php echo $ci;?>">
            <input name="name" type="text" value="<?php echo $name;?>">
            <select name="rol" type="text">
                <option value=1 <?php if($rol==1) echo "selected";?>>Administrador</option>
                <option value=2 <?php if($rol==2) echo "selected";?>>Empleado</option>
            </select>
            <?php if(!empty($message)): ?>
              <p>
                <?= $message ?>
            </p>
              <?php endif; ?>
            <input type="submit" name="Update" value="Actualizar">
          </div>
          <a href="../users.php"><i class="fa-solid fa-angles-left"></i> Atras</a>
      </form>
  </div>
  </body>
</html>