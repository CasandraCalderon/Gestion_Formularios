<?php
    require '../../../database/bd.php';
    session_start();
    if (isset($_SESSION['id_user']) && $_SESSION['rol']==1){
      if(isset($_GET['id_a'])){
        $id_a = $_GET['id_a'];
        $query = "SELECT * FROM areas WHERE id_a = $id_a";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $abbr_a = $row['abbr_a'];
            $name_area = $row['name_area'];
        }
    }
    $ruta = $name_area;
    if (isset($_POST['Update'])) {
        $id_a = $_GET['id_a'];
        $abbr_a = $_POST['abbr_a'];
        $name_area = $_POST['name_area'];
        if ($name_area != $ruta){
          if(!file_exists("../../../assets/files/".$name_area)){

            $query = "UPDATE forms set name_area = '$name_area' WHERE  name_area= '$ruta'";
            $result = mysqli_query($conn, $query);
            rename("../../../assets/files/".$ruta, "../../../assets/files/".$name_area);
            $query = "UPDATE areas set abbr_a = '$abbr_a', name_area = '$name_area' WHERE id_a = $id_a";
            $result = mysqli_query($conn, $query);
            if(!$result){
                die("Failed");
            } else {
              $_SESSION['message'] = 'Area Actualizada Correctamente';
              $_SESSION['message_type'] = 'warning';
              header("location: ../area.php"); 
            }
          } else {
            $_SESSION['message'] = 'Ya existe una Area con ese nombre';
            $_SESSION['message_type'] = 'warning';
            header("location: ../area.php"); 
          }
        }
        else {
          $query = "UPDATE areas set abbr_a = '$abbr_a', name_area = '$name_area' WHERE id_a = $id_a";
          $result = mysqli_query($conn, $query);
          if(!$result){
              die("Failed");
          } else {
            $_SESSION['message'] = 'Area Actualizada Correctamente';
            $_SESSION['message_type'] = 'warning';
            header("location: ../area.php"); 
          }
        }
    }

    } else {
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
      <h3>Editar Area</h3>
      <form action="edit_area.php?id_a=<?php echo $_GET['id_a'];?>" method="POST" autocomplete="off">
          <div class="inputBox"> 
            <input name="abbr_a" type="text" value="<?php echo $abbr_a;?>"  onkeyup="javascript:this.value=this.value.toUpperCase();">
            <input name="name_area" type="text" value="<?php echo $name_area;?>"  onkeyup="javascript:this.value=this.value.toUpperCase();">
            <?php if(!empty($message)): ?>
              <p>
                <?= $message ?>
            </p>
              <?php endif; ?>
            <input type="submit" name="Update" value="Actualizar">
          </div>
          <a href="../area.php"><i class="fa-solid fa-angles-left"></i> Atras</a>
      </form>
  </div>
  </body>
</html>