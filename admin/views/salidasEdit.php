<?php
    $cancelado = '';
    $pedido = $_GET["idSalida"];
    $busca = mdlSalidas::mdlBuscaSalida($pedido, "salidasEnc");
    if ($busca["status"] == 'C') $cancelado = '<div class="card-options"><h3 class="heading-danger">Cancelado</h3> </div>';
    $productosJSON = productos::ctlBuscaProdsSalidaJSON($pedido);
?>
<div><p></p></div>
    <div class="row">
        
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card m-b-20">
            <form method="POST">
                <div class="card-header">
                    <h3 class="card-title">Información del Cliente</h3>
                    <!-- <div class="card-options"><button type="submit" class="btn btn-warning" name="updtPedido">Actualizar Pedido</button> </div> -->
                    <div class="card-options"><button type="" class="btn btn-primary" disabled>Ticket</button> </div>
                </div>
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label text-center"># ticket</label>
                            <h3 class="text-center"><strong> <?php echo $busca['pedido']; ?></strong></h3>
                            <input type="text" class="form-control" name="pedidoNum" id="pedidoNum" value="<?php echo $busca["pedido"] ?>" hidden>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Proveedor</label>
                            <select class="form-control" name="idCliente">
                                <?php $proveedores = new clientes(); $proveedores -> ctlListClientesSelected($busca['idCliente']);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Concepto</label>
                            <select class="form-control custom-select select2" name="concepto" id="concepto">
                                <?php
                                    if($busca['concepto'] == 'salida') echo '<option value="salida" selected>Salida</option>'; else echo '<option value="salida">Salida</option>';  
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
                            
                            <input type="text" class="form-control" name="totalPedidoBD" id="totalPedidoBD" value='<?php echo $busca["totalPedido"]; ?>' hidden>
                            
                        </div>
                    </div>
                    <input type="text" class="form-control" name="pedidoBD" id="pedidoBD" value='<?php echo $productosJSON; ?>' hidden>
                    <input type="text" class="form-control" name="eliminadosBD" id="eliminadosBD" value='' hidden>
                    <div class="col-sm-9 col-md-9">
                        
                    </div>

                </div>
            </form>
            <?php
                $registro = new Salidas();
                $registro -> ctlRegistraPedido();
            ?>
            </div>
        </div>

            <!-- <div class="card m-b-20">
                <div class="card-body">
                    <form action="busca.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" id="searchBox" oninput = "buscaJS(this.value)" placeholder="Busque un producto aqui">
                        </div>
                    </form>

                    <div class="user-tabel table-responsive border-top">                  
                        <table class="table card-table table-bordered table-hover table-vcenter text-nowrap">
                            <thead>
                                <th>Producto</th>
                                <th>Lote</th>
                                <th>Disp</th>
                                <th>$</th>
                                <th style="width: 40.406px;">Cant</th>
                                <th></th>
                            </thead>
                            <tbody class="text-left" id="productsTable">             
                            </tbody>
                        </table>
                    </div>

                </div>
            </div> -->
        </div>

        <div class="col-xl-6 col-lg-6 col-md-8">    
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Total </h3>
                <?php echo $cancelado; ?>
                <div class="card-options"><h3 id="totalPedido">$</h3> </div>
            </div>
                <div class="card-body">
                    <div class="user-tabel table-responsive border-top">                  
                        <table class="table card-table table-bordered table-hover table-vcenter text-nowrap">
                            <thead>
                                <th>Producto</th>
                                <th>Lote</th>
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

    <?php
        $registro = new Salidas();
        $registro -> ctlEditaSalida();
    ?>



