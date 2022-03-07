<?php
    include("partials/header.php") 
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php  $_SESSION["message"] = null;} ?>
            <div class="card card-body">
                <form action="area/save_area.php" method="POST">
                    <div class="form-group">
                        <input name="nro_area" type="text" class="form-control" placeholder="Area number" autofocus>
                    </div>
                    <div class="form-group">
                        <input name="name" type="text" class="form-control" placeholder="Name" autofocus>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="save_area" value="Save Area">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <form class="form-inline float-right" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" id="campo" name="campo" placeholder="Number or Name">
                </div>
                <input type="submit" class="btn btn-success text-light mb-2" id="enviar" name="enviar" value="Search"/>
            </form>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>NOMBRE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require '../../bd.php';
                    $where = "";
                    if(!empty($_POST)){
                        $valor = $_POST['campo'];
                        if(!empty($valor)){
                            $where = "WHERE nro_area = '$valor' OR name LIKE '%$valor%'";
                        }
                    }
                    $query = "SELECT * FROM areas $where ORDER BY nro_area";
                    $resultado = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($resultado)) { ?>
                    <tr>
                        <td><?php echo$row['nro_area']; ?></td>
                        <td><?php echo$row['name']; ?></td>
                        <td>
                        <a href="area/edit_area.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>  <a href="area/delete_area.php?id=<?php echo $row['id'] ?>" class="btn btn-danger ">
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

<?php include("partials/footer.php") ?>