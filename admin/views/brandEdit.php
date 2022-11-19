<?php

    $brand = $_GET["idEditar"];
    $busca = mdlBrands::mdlBusca($brand, "brands");

?>

<div class="page-header">
    <h4 class="page-title">Actualizar Informacion de Marca</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?page=userList">Brands Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Brand Edit</li>
    </ol>
</div>
<div class="row ">
    <div class="col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h3 class="card-title">Información</h3>

            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-sm-5 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo $busca['nombre']; ?>" >
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-right">
                <input type="text" name="brandId" class="form-control" value="<?php echo $brand; ?>" hidden />
                <a href="index.php?page=brandList"><button name="btnCancel" class="btn btn-warning">Cancel</button></a>
                <button type="submit" name="btnActualiza" id="login" class="btn btn-primary">Actualizar</button>
            </div>
            <?php
                $registro = new brands();
                $registro -> ctrActualiza();
            ?>
        </form>
    </div>

</div>