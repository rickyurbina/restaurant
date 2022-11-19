<?php

    $producto = $_GET["idEntrada"];
    $busca = mdlProductos::mdlBusca($producto, "productos");

?>

<div class="page-header">
    <h4 class="page-title">Captura de entradas de producto</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Product Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product Add</li>
    </ol>
</div>
<div class="row ">
    <div class="col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h3 class="card-title">Se registrará una entrada para: <strong> <?php echo $busca['name']; ?> </h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <!-- <h3>Se registrará una entrada para: <strong> <?php echo $busca['name']; ?> </strong> </h3> -->
                            <input type="text" class="form-control" name="nombre" value="<?php echo $busca['name']; ?>" hidden>
                            <input type="text" name="idProducto" class="form-control" value="<?php echo $busca['idProducto']; ?>" hidden />
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Lote</label>
                            <input type="text" class="form-control" name="lote" placeholder="" >
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" placeholder="" >
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Medida del producto</label>
                            <select class="form-control custom-select select2" name="medida" >
                                <option value="Kgs">Kgs</option>
                                <option value="Pzas">Piezas</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Costo Unitario</label>
                            <input type="text" class="form-control" name="costo" placeholder="" >
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Proveedor</label>
                            <select class="form-control" name="idProveedor">
                                <?php $proveedores = new providers(); $proveedores -> ctlListProveedores();?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-label">Fecha Movimiento</label>
                            <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" name="fechaMovimiento" id="fechaMovimiento">
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" id="login" class="btn btn-primary">Registrar</button>
            </div>
            <?php
                $registro = new Movimientos();
                $registro -> ctrRegistraEntrada();
            ?>
        </form>
    </div>

</div>