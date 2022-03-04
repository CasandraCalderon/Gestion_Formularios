<?php
session_start();
include("partials/header.php") 
?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php  $_SESSION["message"] = null;} ?>
            <div class="card card-body">
                <form action="users/save_user.php" method="POST">
                    <div class="form-group">
                        <input name="CI" type="text" class="form-control" placeholder="CI" autofocus>
                    </div>
                    <div class="form-group">
                        <input name="name" type="text" class="form-control" placeholder="Name" autofocus>
                    </div>
                    <div class="form-group">
                        <select name="rol" type="text" class="form-control" id="exampleFormControlSelect1">
                        <option>Administrador</option>
                        <option>Usuario</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" autofocus>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="save_user" value="Save User">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            
        </div>
    </div>
</div>
<?php include("partials/footer.php") ?>