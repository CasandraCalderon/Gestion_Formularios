<?php
require '../../../database/database.php';
if (isset($_POST['save_area'])){
    
      if (!empty($_POST['abbr_a']) && !empty($_POST['name_area'])) {
        $ruta = "../../../assets/files/".$_POST['name_area'];
        if(!file_exists($ruta)){
          $sql = "INSERT INTO areas (abbr_a, name_area) VALUES (:abbr_a, :name_area)";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':abbr_a', $_POST['abbr_a']);
          $stmt->bindParam(':name_area', $_POST['name_area']);
          if ($stmt->execute()) {
            mkdir($ruta, 0777, true);
            $_SESSION['message'] = 'Area Guardada Exitosamente';
            $_SESSION['message_type'] = 'success';
            header("location: ../area.php");
          }
        } else {
          $_SESSION['message'] = 'Area Existente';
          $_SESSION['message_type'] = 'warning';
          header("location: ../area.php");
        }
      } else {
        $_SESSION['message'] = 'Complete todo el formulario';
        $_SESSION['message_type'] = 'danger';
        header("location: ../area.php"); 
      }
}
?>