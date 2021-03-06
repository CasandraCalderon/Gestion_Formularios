<?php
    include("partials/header.php") 
?>
<div class="container-fluid">
<br>
    <div class="row">
        <div class="col-md-3">
            <div class="card card-body">
                <form action="area/save_area.php" method="POST" autocomplete="off">
                    <div class="form-group">
                        <input name="abbr_a" type="text" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="sigla" autofocus>
                    </div>
                    <div class="form-group">
                        <input name="name_area" type="text" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Nombre" autofocus>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="save_area" value="Guardar Area">
                </form>
            </div>
            <br>
            <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" id="myAlert" role="alert">
                <?= $_SESSION['message']?>
            </div>
            <?php  $_SESSION["message"] = null;} ?>
        </div>
        <div class="col-md-9">
            <div class="container" style="margin-top: 10px;padding: 5px">
        <table id="tablax" class="table table-striped table-bordered text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>SIGLA</th>
                        <th>NOMBRE</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require '../../database/bd.php';
                    $where = "";
                    if(!empty($_POST)){
                        $valor = $_POST['campo'];
                        if(!empty($valor)){
                            $where = "WHERE abbr_a = '$valor' OR name LIKE '%$valor%'";
                        }
                    }
                    $query = "SELECT * FROM areas $where ORDER BY abbr_a";
                    $resultado = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($resultado)) { ?>
                    <tr>
                        <td><?php echo$row['abbr_a']; ?></td>
                        <td><?php echo$row['name_area']; ?></td>
                        <td>
                        <a href="area/edit_area.php?id_a=<?php echo$row['id_a'] ?>" class="btn btn-secondary">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>  <a href="area/delete_area.php?id_a=<?php echo $row['id_a'] ?>" class="btn btn-danger ">
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