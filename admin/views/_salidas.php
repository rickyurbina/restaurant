<div class="page-header">
    <h4 class="page-title">Registro de Pedidos</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Products Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products Register</li>
    </ol>
</div>

<form method="POST" name="entradas">
<div class="row col-12">
    <div class="col-xl-6">
        <div class="card m-b-20">
            <div class="card-header">
                <h3 class="card-title">Información del Cliente</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label"># Pedido</label>
                            <input type="text" class="form-control" name="pedidoNum" id="pedidoNum">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Cliente</label>
                            <select class="form-control" name="idCliente" id="idCliente">
                                <?php $clientes = new clientes(); $clientes -> ctlListClientes();?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Concepto</label>
                            <select class="form-control custom-select select2" name="concepto" id="concepto">
                                <option value="entrada">Entrada</option>
                                <option value="ajuste">Ajuste</option>
                                <option value="saldo">Saldo Inicial</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Fecha</label>
                            <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" name="fechaMovimiento" id="fechaMovimiento">
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
                            <label class="form-label">Lote</label>
                            <input type="text" class="form-control" name="lote" id="lote">
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
                            <label class="form-label">Precio</label>
                            <input type="text" class="form-control" name="precio" id="precio" >
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1">
                    </div>
                    <div class="col-sm-1 col-md-1">
                        <a href="" type="" id="agregaProductoLista" class="btn btn-success">+</a>
                    </div>
                    <div class="col-12" id="error"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col sm-12"></div>
    <div class="col-lg-3 col-sm-12 ">
        <div class="card m-b-20">
                <div class="card-header">
                    <h3 class="card-title" id="totalOrden">Total $<span id="totalOrden">00</span></h3>
                </div>
        </div>
    </div>
    
    <div class="col-sm-12 ">

        <div class="form-group">
            <input type="text" class="form-control" name="productosBD" id="productosBD">
        </div>
    </div>
    <!-- end col -->
</div >

<div class="text-right">
    <button type="submit" id="regOrden" name="regPedido" class="btn btn-primary">Guardar Pedido</button>
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
                            <th>Lote</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
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
    $registro = new Salidas();
    $registro -> ctlRegistraPedido();
    
?>

