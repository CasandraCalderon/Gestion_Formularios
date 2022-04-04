<?php
require '../../../database/bd.php';
session_start();
if (isset($_GET['id_f'])) {
    $id = $_GET['id_f'];
    $query = "SELECT * FROM forms WHERE id_f = $id";
    $result = mysqli_query($conn, $query);
     if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $ruta = $row['name_area'];
            $name_document = $row['name_document'];
            $file = "../../../assets/files/".$ruta."/".$name_document;
        }
  if (is_file($file)) {
    $filename = $name_document;
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=\"$filename\"");
    readfile($file);

  } else {
    die("Error: no se encontró el archivo '$file'");
  }
}
?>