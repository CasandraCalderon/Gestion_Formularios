<?php
    require '../../../bd.php';
    session_start();
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM users WHERE id= $id";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Failed");
        }
        $_SESSION['message'] = 'User Removed Successfuly';
        $_SESSION['message_type'] = 'danger';
        header("location: ../users.php"); 
    }
?>