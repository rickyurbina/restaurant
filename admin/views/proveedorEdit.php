<?php

    $proveedor = $_GET["idEditar"];
    $busca = mdlProviders::mdlBusca($proveedor, "proveedores");

?>

<div class="page-header">
    <h4 class="page-title">Actualizar Informacion de Proveedor</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?page=userList">Providers Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Provider Edit</li>
    </ol>
</div>
<div class="row ">
    <div class="col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h3 class="card-title">Información General</h3>

            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo $busca['nombre']; ?>" >
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label">Direccion</label>
                            <input type="text" class="form-control" name="direccion" value="<?php echo $busca['direccion']; ?>">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" value="<?php echo $busca['telefono']; ?>">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $busca['email']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="text" name="proveedorId" class="form-control" value="<?php echo $proveedor; ?>" hidden />
                <a href="index.php?page=userList"><button name="btnCancel" class="btn btn-warning">Cancelar</button></a>
                <button type="submit" name="btnActualiza" id="login" class="btn btn-primary">Actualizar</button>
            </div>
            <?php
                $registro = new providers();
                $registro -> ctrActualiza();
            ?>
        </form>
    </div>

</div>