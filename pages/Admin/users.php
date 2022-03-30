<?php
    include("partials/header.php") 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-body">
                <form action="users/save_user.php" method="POST" autocomplete="off">
                    <div class="form-group">
                        <input name="CI" type="text" class="form-control" placeholder="CI" autofocus>
                    </div>
                    <div class="form-group">
                        <input name="name" type="text" class="form-control" placeholder="Name" autofocus>
                    </div>
                    <div class="form-group">
                        <select name="rol" type="text" class="form-control" id="exampleFormControlSelect1">
                            <option value=1>Administrador</option>
                            <option value=2>Empleado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" autofocus>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="save_user" value="Save User">
                </form>
            </div>
            <br>
            <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible" id="myAlert" role="alert">
                <?= $_SESSION['message']?> 
            </div>
            <?php  $_SESSION["message"] = null;} ?>
        </div>
        <div class="col-md-9">
        <div class="container" style="margin-top: 10px;padding: 5px">
    <table id="tablax" class="table table-striped table-bordered" style="width:100%; text-align: center;">
                <thead>
                    <tr>
                        <th >CI</th>
                        <th >NOMBRE</th>
                        <th >ROL</th>
                        <th >ESTADO</th>
                        <th >ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require '../../database/bd.php';
                    $where = "";
                    if(!empty($_POST)){
                        $valor = $_POST['campo'];
                        if(!empty($valor)){
                            $where = "WHERE CI = '$valor' OR name LIKE '%$valor%'";
                        }
                    }
                    $query = "SELECT * FROM users $where";
                    $resultado = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($resultado)) { ?>
                    <tr>
                        <td ><?php echo$row['CI']; ?></td>
                        <td ><?php echo$row['name']; ?></td>
                        <?php if($row['rol']==1){ ?>
                            <td>Administrador</td>
                        <?php } ?>
                        <?php if($row['rol']==2){?>
                            <td >Empleado</td>
                        <?php } ?>

                        <?php if($row['state']==1){ ?>
                            <td><span class="badge badge-success" style="font-size: 15px;">Habilitado</span></td>
                        <?php } ?>
                        <?php if($row['state']==0){?>
                            <td><span class="badge badge-danger" style="font-size: 15px;">Deshabilitado</span></td>
                        <?php } ?>

                        <td>
                        <a href="users/edit_user.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>  <a href="users/delete_user.php?id=<?php echo $row['id'] ?>" class="btn <?php if($row['state']==="1"){?>btn-success<?php }else {?>btn-danger<?php }?>">
                            <i class="<?php if($row['state']===1){?>fa-solid fa-lock-open<?php }else {?>fa-solid fa-lock<?php }?>"></i>
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