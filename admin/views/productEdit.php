<?php

    $producto = $_GET["idEditar"];
    $busca = mdlProductos::mdlBusca($producto, "productos");

?>

<div class="page-header">
    <h4 class="page-title">Actualizar Informacion de Producto</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?page=userList">Product Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product Edit</li>
    </ol>
</div>

<div class="row ">
    <div class="col-lg-8">
        <form enctype="multipart/form-data" class="card" method="POST">
            <div class="card-header">
                <h3 class="card-title">New Product Information</h3>

            </div>
            <div class="card-body">
                <div class="row">

                <div class="col-sm-4 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Clave de Producto</label>
                        <input type="text" class="form-control" name="claveProducto" value="<?php echo $busca['claveProducto']; ?>" required >
                    </div>
                </div>

                <div class="col-sm-8 col-md-8">
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $busca['name']; ?>" required >
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Brand</label>
                        <!-- <input type="text" class="form-control" name="brand" value="<?php echo $busca['brand']; ?>" > -->
                        <select class="form-control" name="brand">
                            <?php $brands = new Brands(); $brands -> ctlListBrandsSelected($busca['brand']);?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6 col-md-5">
                    <div class="form-group">
                        <label class="form-label">Equipment Type</label>
                        <select class="form-control" name="eqType" value="Selected">
                            <?php $eqTypes = new equipmentType(); $eqTypes -> ctlListEqTypesSelected($busca['eqType']);?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Day Cost</label>
                        <input type="number" class="form-control" name="dayPrice" value="<?php echo $busca['dayPrice']; ?>" >
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Week Cost</label>
                        <input type="number" class="form-control" name="weekPrice" value="<?php echo $busca['weekPrice']; ?>" >
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label"> Month Cost</label>
                        <input type="number" class="form-control" name="monthPrice" value="<?php echo $busca['monthPrice']; ?>" >
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="features" value='<?php echo $busca['features']; ?>' id="featuresBD" hidden>
                    </div>
                </div>

                <div class="col-md-5">

                </div>
                
                <div class="col-lg-3 col-sm-12"><p></p></div>
                <div class="col-lg-6 col-sm-12">
                <label class="form-label">Image</label>
                <input type="file" class="dropify" name="image" data-height="180"  
                            data-allowed-file-extensions="jpg png jpeg"
                            data-default-file="<?php echo $busca['image']; ?>" />
                </div>
                    

                </div>
            </div>
            <div class="card-footer text-right">
                <input type="text" name="idProducto" class="form-control" value="<?php echo $producto; ?>" hidden />
                <input type="text" name="oldImage" class="form-control" value="<?php echo $busca['image'];?>" hidden />
                <button type="submit" name="btnActualiza" id="login" class="btn btn-primary">Update</button>
            </div>
            <?php
                 $registro = new productos();
                 $registro -> ctrActualiza();
            ?>
        </form>
    </div>

    <div class="col-xl-4 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Custon Features</h3>                
            </div>
            <br>
            <form id="featuresForm">
                <div class="col-sm-12 col-md-12">
                    <div class="form-group" id="contenidoFt">
                        <div class="row">
                            
                            <div class="col-sm-5 col-md-5">
                                <label class="form-label">Feature</label>
                                <input type="text" class="form-control" id="featName">
                            </div>
                            
                            <div class="col-sm-5 col-md-5">
                                <label class="form-label">Value</label>
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