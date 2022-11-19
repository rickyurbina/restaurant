<div class="page-header">
    <h4 class="page-title">Registro de Marca</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Brands Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
    </ol>
</div>
<div class="row ">
    <div class="col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h3 class="card-title">Información de Marcas</h3>

            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-8 col-md-8">
                        <div class="form-group">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Manzana Golden" >
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" placeholder="Perez García" >
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

                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-label">Fecha Nacimiento</label>
                            <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" name="fechaNacimiento">
                        </div>
                    </div> 
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Tipo Cliente</label>
                            <select class="form-control custom-select select2" name="tipoCliente" >
                                <option value="1">Socio</option>
                                <option value="2">Estudiante</option>
                                <option value="3">Referido</option>
                                
                            </select>
                        </div>
                    </div>-->

                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" id="login" class="btn btn-primary">Registrar</button>
            </div>
            <?php
                 $registro = new brands();
                 $registro -> ctrRegistra();
            ?>
        </form>
    </div>

</div>