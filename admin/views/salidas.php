<?php
    $orden = new Movimientos(); 
    $siguiente = $orden -> ctrSiguienteRegistro('salidas'); 
?>
<div class="espaciador-rustico">
    <p></p>
</div>
    <div class="row">

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
            <div class="card">
                <div class="card-body ">
                    <form method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" id="searchCode" onchange = "buscaCodigo(this.value)" placeholder="Codigo Barras">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
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
                            <tbody class="text-left" id="productsTable">             
                            </tbody>
                        </table>
                    </div>
                    <div id="error"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Total Pedido </h3>
                    
                </div>
                <div class="card-body ">
                    <div class="card-body">
                        <div class="user-tabel table-responsive border-top">                  
                            <table class="table card-table table-bordered table-hover table-vcenter text-nowrap">
                                <thead>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th></th>
                                </thead>
                                <tbody class="text-left" id="listaPedido">             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-3">
            <div class="card overflow-hidden">

                <!-- <div class="card-header"> </div> -->

                <div class="card-body ">
                    <form method="POST">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Cliente</label>
                                <select class="form-control mb-5" name="idCliente" id="idCliente">
                                    <?php $clientes = new clientes(); $clientes -> ctlListClientes();?>
                                </select>
                                <label class="form-label">Descuento General (%)</label>
                                <input type="text" class="form-control mb-5" name="descuento" id="descuento" value="0" onchange = "calculaDescuento(this.value)">
                                
                                <label class="form-label">Pago con :</label>
                                <select class="form-control" name="tipoPago" id="idCliente">
                                    <option value="E">Efectivo</option>
                                    <option value="T">Tarjeta Credito/Debito</option>
                                    <option value="O">Otro</option>
                                </select>

                                <input type="text" class="form-control" name="pedidoNum" id="pedidoNum" value="<?php echo $siguiente; ?>" hidden>
                                <input type="text" class="form-control" name="concepto" id="concepto" value="venta" hidden>
                                <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" name="fechaMovimiento" id="fechaMovimiento" hidden>
                                <input type="text" class="form-control" name="pedidoBD" id="pedidoBD" hidden >
                                <input type="text" class="form-control" name="totalPedidoBD" id="totalPedidoBD" hidden>
                                <input type="text" class="form-control" name="valorDescuento" id="valorDescuento" hidden>
                                <input type="text" class="form-control" name="pedidoNeto" id="pedidoNeto" hidden>

                            </div>
                        </div>
                        <div class="card-options"><h3 id="totalPedido">$</h3> </div>
                            
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-blue col-12" id="btnCobrar" name="regPedido">Cobrar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
    $registro = new Salidas();
    $registro -> ctlRegistraPedido();
?>








