<?php
    include("partials/header.php") 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="card card-body">
                <form action="forms/save_form.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                        <select name="name_area" type="text" class="form-control" id="name_area">
                        <?php
                            require '../../database/bd.php';
                            $query = "SELECT * FROM areas ORDER BY abbr_a";
                            $resultado = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($resultado)){ ?>
                                <option value="<?php echo$row['name_area']; ?>"><?php echo$row['abbr_a']; ?>. <?php echo$row['name_area']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="archivo" type="file" class="form-control" accept="application/pdf" autofocus>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="submit" value="Subir">
                </form>
            </div>
            <br>
            <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" id="myAlert" role="alert">
                <?= $_SESSION['message']?>
            </div>
            <?php  $_SESSION["message"] = null;} ?>
        </div>
        <div class="col-md-10">
        <form class="form-inline float-left" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="campo1" type="text" class="form-control" id="campo1">
                        <option>Todas las Areas...</option>
                        <?php
                            require '../../database/bd.php';
                            $query = "SELECT * FROM areas ORDER BY abbr_a";
                            $resultado = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($resultado)){ ?>
                                <option value="<?php echo$row['name_area']; ?>"><?php echo$row['abbr_a']; ?>. <?php echo$row['name_area']; ?></option>
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
                        <td><?php echo$row['date']; ?></td>
                        <td>
                        <a href="forms/download_form.php?id_f=<?php echo $row['id_f'] ?>" class="btn btn-success">
                            <i class="fa-solid fa-file-arrow-down"></i>
                        </a>
                        <a href="forms/view_form.php?id_f=<?php echo $row['id_f'] ?>" class="btn btn-info">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="forms/delete_form.php?id_f=<?php echo $row['id_f'] ?>" class="btn btn-danger ">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>     
        </div>  
    </div>
    </div>  
</div>

<?php include("partials/footer.php") ?>