<?php
    include("partials/header.php") 
?>
<div class="container-fluid">
<ul class="list-unstyled">
    <form class="form-inline float-left" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="campo1" type="text" class="form-control" id="campo1">
                        <option>Todas las Areas...</option>
                        <?php
                            require '../../database/bd.php';
                            $query = "SELECT * FROM areas ORDER BY abbr_a";
                            $resultado = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($resultado)){ ?>
                                <option value="<?php echo$row['name']; ?>"><?php echo$row['abbr_a']; ?>. <?php echo$row['name']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                <input type="submit" class="btn btn-success text-light mb-2" id="enviar" name="enviar" value="Seleccionar Area"/>
            </form>
    <br><br>
    <div class="container">
            <table id="tablax" class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>AREA</th>
                        <th>FECHA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     require '../../database/bd.php';
                     $where = "";
                    if(!empty($_POST)){
                        $valor1 = $_POST['campo1'];
                       if (!empty($valor1) && $valor1!=='All documents...'){
                            $where = "WHERE name_area = '$valor1'";
                        }
                        
                    }
                    $query = "SELECT * FROM forms $where ORDER BY name_area";
                    $resultado = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($resultado)) { ?>
                    <tr>
                        <td><?php echo$row['name_document']; ?></td>
                        <td><?php echo$row['name_area']; ?></td>
                        <td><?php echo$row['date']; ?></td>
                        <td>
                        <a href="../../pages/Admin/forms/download_form.php?id_f=<?php echo $row['id_f'] ?>" class="btn btn-success">
                            <i class="fa-solid fa-file-arrow-down"></i>
                        </a>
                        <a href="../../pages/Admin/forms/view_form.php?id_f=<?php echo $row['id_f'] ?>" class="btn btn-info">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</div>
<?php include("partials/footer.php") ?>