<div class="page-header">
    <h4 class="page-title">Products</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Product Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
    </ol>
</div>


<div class="row ">
    <div class="col-lg-8">
        <form enctype="multipart/form-data" class="card" method="POST">
            <div class="card-header">
                <h3 class="card-title">Registro de nuevo producto</h3>

            </div>
            <div class="card-body">
                <div class="row">
                
                <div class="col-sm-4 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Clave de Producto</label>
                        <input type="text" class="form-control" name="claveProducto" placeholder="Product Name" required >
                    </div>
                </div>

                <div class="col-sm-8 col-md-8">
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" placeholder="Product Name" required >
                    </div>
                </div>
                <div class="col-sm-5 col-md-5">
                    <div class="form-group">
                        <label class="form-label">Marca</label>
                        <select class="form-control" name="brand">
                            <?php $brands = new Brands(); $brands -> ctlListBrands();?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Categoria</label>
                        <select class="form-control" name="eqType">
                            <?php $eqTypes = new equipmentType(); $eqTypes -> ctlListEqTypes();?>
                        </select>
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
                
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Precio 1</label>
                        <input type="number" class="form-control" name="dayPrice" placeholder="No incluya signos  $ , ' " >
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Precio 2</label>
                        <input type="number" class="form-control" name="weekPrice" placeholder="No incluya signos  $ , ' " >
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label"> Precio 3</label>
                        <input type="number" class="form-control" name="monthPrice" placeholder="No incluya signos  $ , ' " >
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="features" id="featuresBD" hidden>
                    </div>
                </div>

                <div class="col-md-5">

                </div>
                
                <div class="col-lg-3 col-sm-12"><p></p></div>
                    <div class="col-lg-6 col-sm-12">
                        <label class="form-label">Imagen</label>
                            <input type="file" class="dropify" name="image" data-height="180"  
                            data-allowed-file-extensions="jpg png jpeg" />
                    </div>    
                </div>
                
            </div>
            <div class="card-footer text-right">
                <button type="submit" name="registrar" class="btn btn-primary">Guardar</button>
            </div>
            <?php
                 $registro = new productos();
                 $registro -> ctrRegistra();
            ?>
        </form>

    
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Valores personalizados</h3>                
            </div>
            <br>
            <form id="featuresForm">
                <div class="col-sm-12 col-md-12">
                    <div class="form-group" id="contenidoFt">
                        <div class="row">
                            
                            <div class="col-sm-5 col-md-5">
                                <label class="form-label">Característica</label>
                                <input type="text" class="form-control" id="featName">
                            </div>
                            
                            <div class="col-sm-5 col-md-5">
                                <label class="form-label">Valor</label>
                                <input type="text" class="form-control" id="featValue">
                            </div>
                            <div class="col-sm-1 col-md-1">
                                <br>
                                <button id="addFeat" class="btn btn-blue">+</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <div class="card-body">
                <div class="">
                    <div id="featList"></div>
                </div>
            </div>
        </div>
    </div>
</div>