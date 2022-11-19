<?php

    $usuario = $_GET["idEditar"];
    $busca = mdlUsuarios::mdlBusca($usuario, "usuarios");

?>

<div class="page-header">
    <h4 class="page-title">Actualizar Informacion de Usuario</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?page=userList">Users Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">User Edit</li>
    </ol>
</div>
<div class="row ">
    <div class="col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h3 class="card-title">Información Personal</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-label">Nombre Corto</label>
                            <input type="text" class="form-control" name="nickName" placeholder="Sobrenombre" value="<?php echo $busca['nickName']; ?>" >
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Usuario</label>
                            <input type="text" class="form-control" placeholder="usuario" >
                        </div>
                    </div> -->
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $busca['email']; ?>" >
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="nombres" placeholder="Juan" value="<?php echo $busca['nombres']; ?>" >
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" placeholder="Perez García" value="<?php echo $busca['apellidos']; ?>">
                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" placeholder="Home Address" >
                        </div>
                    </div> -->
                    <div class="col-sm-6 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" placeholder="6141234455" value="<?php echo $busca['telefono']; ?>" >
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Postal Code</label>
                            <input type="number" class="form-control" placeholder="ZIP Code">
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Permisos en el sistema</label>
                            <select class="form-control custom-select select2" name="permisos" >
                                
                                <option <?php if ($busca['permisos'] == "administrador") echo "selected"; ?> value="administrador">Administrador</option>
                                <option <?php if ($busca['permisos'] == "usuario") echo "selected"; ?> value="usuario">Usuario</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" value="<?php echo $busca['password']; ?>"  />
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-right">
                <input type="text" name="userId" class="form-control" value="<?php echo $usuario; ?>" hidden />

                <button type="submit" name="btnCancel" class="btn btn-warning">Cancelar</button></a>
                <button type="submit" name="btnActualiza" id="login" class="btn btn-primary">Actualizar</button>
            </div>
            <?php
                $registro = new usuarios();
                $registro -> ctrActualiza();
            ?>
        </form>
    </div>

</div>