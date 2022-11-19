<div class="page-header">
    <h4 class="page-title">Registro de Usuario</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Users Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">User Add</li>
    </ol>
</div>
<div class="row ">
    <div class="col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h3 class="card-title">Información Personal</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-label">Nombre Corto</label>
                            <input type="text" class="form-control" name="nickName" placeholder="Sobrenombre" >
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Usuario</label>
                            <input type="text" class="form-control" placeholder="usuario" >
                        </div>
                    </div> -->
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="nombres" placeholder="Juan" required>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" placeholder="Perez García" required>
                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" placeholder="Home Address" >
                        </div>
                    </div> -->
                    <div class="col-sm-6 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" placeholder="6141234455" >
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Postal Code</label>
                            <input type="number" class="form-control" placeholder="ZIP Code">
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Permisos en el sistema</label>
                            <select class="form-control custom-select select2" name="permisos" >
                                <option value="usuario">Usuario</option>
                                <option value="administrador">Administrador</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required  />
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" id="login" class="btn btn-primary">Registrar</button>
            </div>
            <?php
                $registro = new usuarios();
                $registro -> ctrRegistra();
            ?>
        </form>
    </div>

</div>