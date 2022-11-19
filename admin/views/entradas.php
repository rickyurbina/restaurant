<?php
    $orden = new Movimientos(); 
    $siguiente = $orden -> ctrSiguienteRegistro('entradas'); 
?>

<br>


<div class="row">

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5">
        <div class="card">
            <div class="card-body ">
                <form method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="searchBox" oninput = "buscaJS(this.value)" placeholder="Busque un producto aqui">
                    </div>
                </form>

                <div class="user-tabel table-responsive">                  
                    <table class="table card-table table-bordered table-hover table-vcenter text-nowrap" id="tablaResultados" >
                        <thead>
                            <th>Producto</th>
                            <th>Disp</th>
                            <th>$</th>
                            <th style="width: 40.406px;">Cant</th>
                            <th></th>
                        </thead>
                        <tbody class="text-left" id="productsSearch">             
                        </tbody>
                    </table>
                </div>
                <div id="error"></div>
            </div>
        </div>

        <div class="card m-b-20">
            
            <div class="card-header">
                <h3 class="card-title">Proveedor </h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse collapse" aria-expanded="false" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" name="entradas">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-control" name="idProveedor" id="idProveedor">
                                <?php $proveedores = new providers(); $proveedores -> ctlListProveedores();?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label"># Factura: <?php echo $siguiente; ?></label> 
                            
                            <h3 class="text-center"><strong> </strong></h3>
                            <input type="text" class="form-control" name="ordenNum" id="ordenNum" value="<?php echo $siguiente; ?>" required>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Fecha</label>
                            <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" name="fechaMovimiento" id="fechaMovimiento">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="concepto" id="concepto" value="entrada" hidden>
                            <!-- <select class="form-control custom-select select2" name="concepto" id="concepto">
                                <option value="entrada">Entrada</option>
                                <option value="ajuste">Ajuste</option>
                                <option value="saldo">Saldo Inicial</option>
                            </select> -->
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="productosBD" id="productosBD" placeholder="productosBD" hidden >
                            <input type="text" class="form-control" name="totalPedidoBD" id="totalPedidoBD" placeholder="totalPedidoBD" hidden >
                        </div>
                        <div class="form-group">
                            <button type="submit" id="btnGuardar" name="regOrden" class="btn btn-secondary col-12">Guardar</button><br><br>
                        </div>
                    </div>
                </div>
                </form>
                <?php
                    $registro = new Movimientos();
                    $registro -> ctlRegistraOrden();                
                ?>
            </div>

            

        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Total Factura </h3>
                <div class="card-options"><h3 id="totalFactura">$</h3> </div>
            </div>
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


</div >



