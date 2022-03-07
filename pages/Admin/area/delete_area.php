<?php
    require '../../../bd.php';
    session_start();
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM areas WHERE id= $id";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Failed");
        }
        $_SESSION['message'] = 'Area Removed Successfuly';
        $_SESSION['message_type'] = 'danger';
        header("location: ../area.php"); 
    }
?>