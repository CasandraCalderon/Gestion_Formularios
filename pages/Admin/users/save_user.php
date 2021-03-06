<?php
require '../../../database/database.php';
if (isset($_POST['save_user'])){
      if (!empty($_POST['CI']) && !empty($_POST['name']) && !empty($_POST['rol']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO users (CI, name, rol, password, state) VALUES (:CI, :name, :rol, :password, :state)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':CI', $_POST['CI']);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':rol', $_POST['rol']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
        $state = 1;
        $stmt->bindParam(':state', $state);
    
        if ($stmt->execute()) {
          $_SESSION['message'] = 'Usuario Guardado Exitosamente';
          $_SESSION['message_type'] = 'success';
          header("location: ../users.php");
        }
      } else {
        $_SESSION['message'] = 'Complete the entire form';
        $_SESSION['message_type'] = 'danger';
        header("location: ../users.php"); 
      }
}
?>