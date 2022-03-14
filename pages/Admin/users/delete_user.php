<?php
    require '../../../database/bd.php';
    session_start();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $state = $row['state'];
        }
    }
    if ($state == 1) {
        $query = "UPDATE users set state = 0 WHERE id = $id";
        $_SESSION['message'] = 'User blocked Successfuly';
        $_SESSION['message_type'] = 'warning';
    } else if ($state == 0){
        $query = "UPDATE users set state = 1 WHERE id = $id";
        $_SESSION['message'] = 'User unlocked Successfuly';
        $_SESSION['message_type'] = 'warning';
    }
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Failed");
    }
    header("location: ../users.php"); 
?>