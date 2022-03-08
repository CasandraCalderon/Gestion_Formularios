<?php
    require '../../../bd.php';
    session_start();
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM areas WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $name_area = $row['name'];
        $ruta = "../../../assets/files/".$name_area;
        $files = glob("../../../assets/files/".$name_area."/*");
        foreach($files as $file){
            if(is_file($file))
            unlink($file); //elimino el fichero
        }
        rmdir($ruta);
        $query = "DELETE FROM forms WHERE name_area= '$name_area'";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Failed");
        }
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