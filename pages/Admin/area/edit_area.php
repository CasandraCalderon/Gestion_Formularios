<?php
    require '../../../database/bd.php';
    session_start();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM areas WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $nro_area = $row['nro_area'];
            $name = $row['name'];
        }
    }
    $ruta = $name;
    if (isset($_POST['Update'])) {
        $id = $_GET['id'];
        $nro_area = $_POST['nro_area'];
        $name = $_POST['name'];
        if ($name !== $ruta){
          if(!file_exists("../../../assets/files/".$name)){

            $query = "UPDATE forms set name_area = '$name' WHERE  name_area= '$ruta'";
            $result = mysqli_query($conn, $query);
            rename("../../../assets/files/".$ruta, "../../../assets/files/".$name);
            $query = "UPDATE areas set nro_area = '$nro_area', name = '$name' WHERE id = $id";
            $result = mysqli_query($conn, $query);
            if(!$result){
                die("Failed");
            } else {
              $_SESSION['message'] = 'Area Update Successfuly';
              $_SESSION['message_type'] = 'warning';
              header("location: ../area.php"); 
            }
          } else {
            $_SESSION['message'] = 'Existing area';
            $_SESSION['message_type'] = 'warning';
            header("location: ../area.php"); 
          }
        }
        else {
          $query = "UPDATE areas set nro_area = '$nro_area', name = '$name' WHERE id = $id";
          $result = mysqli_query($conn, $query);
          if(!$result){
              die("Failed");
          } else {
            $_SESSION['message'] = 'Area Update Successfuly';
            $_SESSION['message_type'] = 'warning';
            header("location: ../area.php"); 
          }
        }
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
      <h3>Edit Area</h3>
      <form action="edit_area.php?id=<?php echo $_GET['id'];?>" method="POST" autocomplete="off">
          <div class="inputBox"> 
            <input name="nro_area" type="text" value="<?php echo $nro_area;?>">
            <input name="name" type="text" value="<?php echo $name;?>">
            <?php if(!empty($message)): ?>
              <p>
                <?= $message ?>
            </p>
              <?php endif; ?>
            <input type="submit" name="Update" value="Update">
          </div>
          <a href="../area.php"><i class="fa-solid fa-angles-left"></i> Back</a>
      </form>
  </div>
  </body>
</html>