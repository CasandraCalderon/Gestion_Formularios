<?php
require '../../../database.php';
if (isset($_POST['save_user'])){
    
      if (!empty($_POST['CI']) && !empty($_POST['name']) && !empty($_POST['rol']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO users (CI, name, rol, password) VALUES (:CI, :name, :rol, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':CI', $_POST['CI']);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':rol', $_POST['rol']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
    
        if ($stmt->execute()) {
          echo 'Successfully created new user';
        } else {
          echo 'Sorry there must have been an issue creating your account';
        }
      }
}
?>