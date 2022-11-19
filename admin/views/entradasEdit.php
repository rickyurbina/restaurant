<?php
    $orden = $_GET["idEntrada"];
    $busca = mdlMovimientos::mdlBuscaEntrada($orden, "entradasEnc");
    $productosJSON = productos::ctlBuscaProdsJSON($orden);
?>

<div class="page-header">
    <h4 class="page-title">Edicion de Entradas de Productos</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Stock Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Stock Order Edit</li>
    </ol>
</div>
<form method="POST" name="entradas">
<div class="row col-12">
    <div class="col-xl-6">
        <div class="card m-b-20">
            <div class="card-header">
                <h3 class="card-title">Información del Proveedor</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label text-center"># Orden</label>
                            <h3 class="text-center"><strong> <?php echo $busca['factura']; ?></strong></h3>
                            <input type="text" class="form-control" name="ordenNum" id="ordenNum" value="<?php echo $busca["factura"] ?>" hidden>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Proveedor</label>
                            <select class="form-control" name="idProveedor">
                                <?php $proveedores = new Movimientos(); $proveedores -> ctlListProveedoresSelected($busca['idProveedor']);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Concepto</label>
                            <select class="form-control custom-select select2" name="concepto" id="concepto">
                                <?php
                                    if($busca['concepto'] == 'entrada') echo '<option value="entrada" selected>Entrada</option>'; else echo '<option value="entrada">Entrada</option>';  
                                    if($busca['concepto'] == 'ajuste') echo '<option value="ajuste" selected>Ajuste</option>'; else echo '<option value="ajuste">Ajuste</option>';  
                                    if($busca['concepto'] == 'saldo inicial') echo '<option value="saldo inicial" selected>saldo inicial</option>'; else echo '<option value="saldo inicial">Saldo Inicial</option>';  
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Fecha</label>
                            <input class="form-control fc-datepicker" type="text" name="fechaMovimiento" value="<?php echo $busca["fecha"]; ?>" >
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9">
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card m-b-20">
            <div class="card-header">
                <h3 class="card-title">Producto</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7 col-md-7">
                        <div class="form-group">
                            <label class="form-label">Producto</label>
                            <select class="form-control" name="idProducto" id="idProducto">
                                <?php $productos = new productos(); $productos -> ctlListProductos();?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="" >
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Medida</label>
                            <select class="form-control custom-select select2" name="medida" id="medida" >
                                <option value="Kgs">Kgs</option>
                                <option value="Pzas">Piezas</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Costo Unitario</label>
                            <input type="text" class="form-control" name="costo" placeholder="" id="costo" >
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1">
                    </div>
                    <div class="col-sm-1 col-md-1">
                        <a href="" type="" id="agregaProductoLista" class="btn btn-success">+</a>
                    </div>
                    <div id="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 ">
        <div class="form-group">
            <input type="text" class="form-control" name="productosBD" id="productosBD" value='<?php echo $productosJSON; ?>' hidden>
        </div>
    </div>
    <!-- end col -->

</div >
<div class="text-right">
    <button type="submit" id="regOrden" name="updtOrden" class="btn btn-warning">Actualizar Orden</button>
</div>
    

</form>

<div class="row" data-select2-id="12">
    <div class="col-lg-12 users-list" data-select2-id="11">
        
        <div class="card">
            <div class="card-body">
                <div class="user-tabel table-responsive border-top">                  
                    <table class="table card-table table-bordered table-hover table-vcenter text-nowrap">
                        <thead>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Costo</th>
                            <th></th>
                        </thead>
                        <tbody class="text-left" id="productsTable">             
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
    $registro = new Movimientos();
    $registro -> ctlEditaOrden();
    
?>

