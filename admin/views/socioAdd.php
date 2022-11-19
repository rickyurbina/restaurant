<div class="page-header">
    <h4 class="page-title">Registro de Socios</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Administración de Socios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
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

                    <div class="col-sm-5 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="nombres" placeholder="Juan" >
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" placeholder="Perez García" >
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" maxlength="10" placeholder="6141234455" >
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" >
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-label">Fecha Nacimiento</label>
                            <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" name="fechaNacimiento">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Tipo Socio</label>
                            <select class="form-control custom-select select2" name="tipoSocio" >
                                <option value="1">Cliente</option>
                                <option value="2">Mayorista</option>
                                <option value="3">Otro</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-5">
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" >
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" id="login" class="btn btn-primary">Registrar</button>
            </div>
            <?php
                $registro = new socios();
                $registro -> ctrRegistra();
            ?>
        </form>
    </div>

</div>