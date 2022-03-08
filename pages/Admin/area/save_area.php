<?php
require '../../../database.php';
if (isset($_POST['save_area'])){
    
      if (!empty($_POST['nro_area']) && !empty($_POST['name'])) {
        $ruta = "../../../assets/files/".$_POST['name'];
        if(!file_exists($ruta)){
          $sql = "INSERT INTO areas (nro_area, name) VALUES (:nro_area, :name)";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':nro_area', $_POST['nro_area']);
          $stmt->bindParam(':name', $_POST['name']);
          if ($stmt->execute()) {
            mkdir($ruta, 0777, true);
            $_SESSION['message'] = 'Area save succesfuly';
            $_SESSION['message_type'] = 'success';
            header("location: ../area.php");
          }
        } else {
          $_SESSION['message'] = 'Existing Area';
          $_SESSION['message_type'] = 'warning';
          header("location: ../area.php");
        }
      } else {
        $_SESSION['message'] = 'Complete the entire form';
        $_SESSION['message_type'] = 'danger';
        header("location: ../area.php"); 
      }
}
?>