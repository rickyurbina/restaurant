<div class="page-header">
    <h4 class="page-title">Registro Categoría</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Types Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Type</li>
    </ol>
</div>
<div class="row ">
    <div class="col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h3 class="card-title">Información de Categoría</h3>

            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-8 col-md-8">
                        <div class="form-group">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="John Deere" >
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" id="login" class="btn btn-primary">Registrar</button>
            </div>
            <?php
                 $registro = new equipmentType();
                 $registro -> ctrRegistra();
            ?>
        </form>
    </div>

</div>