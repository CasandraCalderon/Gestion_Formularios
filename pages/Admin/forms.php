<?php
    include("partials/header.php") 
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php  $_SESSION["message"] = null;} ?>
            <div class="card card-body">
                <form action="forms/save_form.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                        <select name="name_area" type="text" class="form-control" id="name_area">
                        <?php
                            require '../../bd.php';
                            $query = "SELECT * FROM areas ORDER BY nro_area";
                            $resultado = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($resultado)){ ?>
                                <option value="<?php echo$row['name']; ?>"><?php echo$row['nro_area']; ?>. <?php echo$row['name']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="archivo" type="file" class="form-control" autofocus>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="submit" value="Save Document">
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
            <form class="form-inline float-right" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="campo1" type="text" class="form-control" id="campo1">
                        <option>All documents...</option>
                        <?php
                            require '../../bd.php';
                            $query = "SELECT * FROM areas ORDER BY nro_area";
                            $resultado = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($resultado)){ ?>
                                <option value="<?php echo$row['name']; ?>"><?php echo$row['nro_area']; ?>. <?php echo$row['name']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" id="campo" name="campo" placeholder="Name">
                </div>
                <input type="submit" class="btn btn-success text-light mb-2" id="enviar" name="enviar" value="Search"/>
            </form>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>AREA</th>
                        <th>FECHA</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     require '../../bd.php';
                     $where = "";
                    if(!empty($_POST)){
                        $valor = $_POST['campo'];
                        $valor1 = $_POST['campo1'];
                        if(!empty($valor1) && $valor1!=='All documents...' && !empty($valor)){
                                $where = "WHERE name_area LIKE '%$valor1%' AND name_document LIKE '%$valor%' ";
                        }
                        else if (!empty($valor1) && $valor1!=='All documents...'){
                            $where = "WHERE name_area LIKE '%$valor1%'";
                        }
                        else if ((!empty($valor))){
                            $where = "WHERE name_document LIKE '%$valor%' ";
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
                        <a href="form/edit_form.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                            <i class="fa-solid fa-user-pen"></i>
                        </a> <a href="form/form_area.php?id=<?php echo $row['id'] ?>" class="btn btn-danger ">
                            <i class="fa-solid fa-trash-can"></i>
                        </a> <a href="form/edit_form.php?id=<?php echo $row['id'] ?>" class="btn btn-success">
                            <i class="fa-solid fa-file-arrow-down"></i>
                        </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</div>
<?php include("partials/footer.php") ?>