<?php
require '../../../bd.php';
session_start();
if(isset($_POST['submit'])) {
    $name_document = $_FILES['archivo']['name'];
    $destino = "../../../assets/files/".$_POST['name_area']."/".$name_document;
    $ruta = $_FILES['archivo']['tmp_name'];
    if($name_document != ""){
        if(copy($ruta, $destino)) {
            $name_area = $_POST['name_area'];
            $query = "INSERT INTO forms (name_document, name_area) VALUES ('$name_document', '$name_area')";
            $result = mysqli_query($conn, $query);
            if(!$result){
                die("Failed");
            }
            $_SESSION['message'] = 'Form Save Successfuly';
            $_SESSION['message_type'] = 'success';
            header("location: ../forms.php"); 

        }
        else {
            echo "Error";
        }
    }
    else {
        $_SESSION['message'] = 'Complete the entire form';
        $_SESSION['message_type'] = 'danger';
        header("location: ../forms.php"); 
    }
} 

?>