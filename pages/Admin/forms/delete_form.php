<?php
    require '../../../database/bd.php';
    session_start();
    if (isset($_GET['id_f'])){
        $id = $_GET['id_f'];
        $query = "SELECT * FROM forms WHERE id_f = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $name_document = $row['name_document'];
            $name_area = $row['name_area'];
        }
        $ruta = "../../../assets/files/".$name_area."/".$name_document;
        unlink($ruta);
        $query = "DELETE FROM forms WHERE id_f= $id";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Failed");
        }
        $_SESSION['message'] = 'Formulario Removido Correctamente';
        $_SESSION['message_type'] = 'danger';
        echo $ruta;
        header("location: ../forms.php"); 
    }
?>