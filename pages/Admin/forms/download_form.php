<?php
require '../../../bd.php';
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM forms WHERE id = $id";
    $result = mysqli_query($conn, $query);
     if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $ruta = $row['name_area'];
            $name_document = $row['name_document'];
            $file = "../../../assets/files/".$ruta."/".$name_document;
        }
  if (is_file($file)) {
    $filename = $name_document;
    header("Content-Type: application/force-download");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    readfile($file);
  } else {
    die("Error: no se encontró el archivo '$file'");
  }
}
?>

<?php
    require '../../../bd.php';
    session_start();
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM forms WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $name_document = $row['name_document'];
            $name_area = $row['name_area'];
        }
        $ruta = "../../../assets/files/".$name_area."/".$name_document;
        unlink($ruta);
        $query = "DELETE FROM forms WHERE id= $id";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Failed");
        }
        $_SESSION['message'] = 'Form Removed Successfuly';
        $_SESSION['message_type'] = 'danger';
        echo $ruta;
        header("location: ../forms.php"); 
    }
?>