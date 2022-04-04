<?php
    require '../../../database/bd.php';
    session_start();
    if (isset($_GET['id_a'])){
        $id_a = $_GET['id_a'];
        $query = "SELECT * FROM areas WHERE id_a = $id_a";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $name_area = $row['name_area'];
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
        $query = "DELETE FROM areas WHERE id_a= $id_a";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Failed");
        }
        $_SESSION['message'] = 'Area removida correctamente';
        $_SESSION['message_type'] = 'danger';
        header("location: ../area.php"); 
    }
?>