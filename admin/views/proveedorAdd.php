<div class="page-header">
    <h4 class="page-title">Registro de Proveedores</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Providers Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Provider Add</li>
    </ol>
</div>
<div class="row ">
    <div class="col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h3 class="card-title">Información General</h3>

            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Manzanas Golden S.A." >
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" placeholder="Ave. Principal #972 Chihuahua, Chih." >
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" placeholder="6141234455" >
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" >
                        </div>
                    </div>                   

                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" id="login" class="btn btn-primary">Registrar</button>
            </div>
            <?php
                $registro = new providers();
                $registro -> ctrRegistra();
            ?>
        </form>
    </div>

</div>